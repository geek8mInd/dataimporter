<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Entities\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class APIController extends Controller
{
    public function getAllCustomers(EntityManagerInterface $em)
    {
        $response = array();

        try{

            $customers = $em->getRepository(Customer::class)->findAll();

            foreach($customers as $customer)
            {
                $response[] = array(
                    'fullname' => $customer->getFirstname() . ' ' . $customer->getLastname(),
                    'email' => $customer->getEmail(),
                    'country' => $customer->getCountry()
                );
            }
            return response()->json(['code'=>200, 'status'=>'ok', 'result'=>$response]);

        } catch (\Throwable $e) {
            return response()->json(['code'=>400, 'status'=>'Bad request.', 'result'=>$response]);
            
        } catch (\Exception $e) {
            return response()->json(['code'=>400, 'status'=>'Bad request.', 'result'=>$response]);
        }
        
    }

    public function getByCustomerID(EntityManagerInterface $em, $id)
    {
        $response = array();
        
        try{

            $customer = $em->getRepository(Customer::class)->find($id);
            
            $response = array(
                'fullname' => $customer->getFirstname() . ' ' . $customer->getLastname(),
                'email' => $customer->getEmail(),
                'username' => $customer->getUsername(),
                'gender' => $customer->getGender(),
                'country' => $customer->getCountry(),
                'city' => $customer->getCity(),
                'phone' => $customer->getPhone(),
            );

            return response()->json(['code'=>200, 'status'=>'ok', 'result'=>$response]);
        } catch (\Throwable $e){
            return response()->json(['code'=>400, 'status'=>'Bad request.', 'result'=>$response]);
        } catch (\Exception $e){
            return response()->json(['code'=>400, 'status'=>'Bad request.', 'result'=>$response]);
        }
        
    }
}
