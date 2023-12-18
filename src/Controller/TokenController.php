<?php
 
namespace App\Controller;
 
use Exception;
use Pimcore\Model\User;
use Pimcore\Tool\Authentication;
use Gamegos\JWT\Token;
use Gamegos\JWT\Encoder;
use Gamegos\JWT\Validator;
 
use Symfony\Component\HttpFoundation\JsonResponse;
 
 
class TokenController
{
    private $user;
    private $encoder;
    private $token;
    private $authenticator;
    private $validator;
 
    public function __construct()
    {
        $this->token = new Token();
        $this->encoder= new Encoder();
        $this->user = new User;
        $this->authenticator = new Authentication;
        $this->validator = new Validator();
    }
  
    public function validateCredential($username,$password)
    {
        $user = $this->user->getByName($username);
        return $this->authenticator->verifyPassword($user,$password);
    }
 
    public function generateToken($crediential): JsonResponse
    {
        $data = json_decode($crediential->getContent(),true);
        if($this->validateCredential($data['username'],$data['password'])){
 
            $this->token->setClaim('username', "{$data['username']}");
            $this->token->setClaim('exp', time() + 60*5);
            $this->encoder->encode($this->token, getenv("JWT_TOKEN"), "HS384");
 
            return new JsonResponse(['Jwt Token :' => $this->token->getJWT(),
            ]);
        }
        else{
            return new JsonResponse(['Jwt Token :' => "Incorrect or Invalid Credential"]);
        }
    }
 
    public function validateToken($userToken)
    {
        try{
            $data = $this->validator->validate($userToken,getenv("JWT_TOKEN"));
            return $data->getClaim("username");
        }
        catch(Exception $e)
        {
            return false;
        }
    }
}