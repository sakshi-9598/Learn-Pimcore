<?php
 
namespace App\Controller;
use App\Controller\TokenController;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
 
/**
* Controller for handling product-related actions.
*/
 
class ProductController extends FrontendController
{
    private $tokenService;
    private $authorized = ['Bussiness', 'Reveiwer', 'CommerceTeam'];
 
    public function __construct()
    {
        $this->tokenService = new TokenController();
    }
    
    /**
     * Get products action.
     *
     * @Route("/api/login", name="getTokenAction", methods={"GET"})
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getTokenAction(Request $request): JsonResponse
    {
    
        return $this->tokenService->generateToken($request);
    }
 
    /**
     * Convert a list of products to an associative array.
     *
     * @param array  $products List of products to convert.
     * @param string $lang Language code.
     *
     * @return array
     */
    private function listToAssoc($products, $lang)
    {
        $productData = [];
 
        // Check if the provided list of products is iterable.
        if (is_iterable($products)) {
            foreach ($products as $product) {
                // Extract relevant product information and build an array.
                $productData[] = [

                    'SKU' => $product->getSku(),
                    'Name_EN' => $product->getProductName('en'),
                    // 'Name_DE' => $product->getName('de'),
                    // 'Name_ES' => $product->getName('es'),
                    'Description_EN' => $product->getProductDescription('en'),
                    // 'Description_DE' => $product->getDescription('de'),
                    // 'Description_ES' => $product->getDescription('es'),
                    'Category' => $product->getCategory()->getKey(),
                    'Country' => $product->getCountryOfOrigin(),
                    'Discount' => $product->getDiscount(),
                    'DiscountedPrice' => $product->getDiscountedPrice(),

                    // 'Color' => $product->getColor()->getHex(),

                    'Brand' => $product->getBrand()->getKey(),
                    'Store' => $product->getStore()[0]->getKey(),

                    'Stock value'=> $product->getInStockValue(),

                    'ActualPrice' => $product->getActualPrice()->__toString(),
                    'Weight' => $product->getWeight()->__toString(),
                    'Length' => $product->getLength()->__toString(),
                    'Width' => $product->getWidth()->__toString(),

                    'Manufacturer Address' => $product->getManufacturerAddress(),
                    'Material Used' => $product->getMaterialUsed(),
                
                    'Season' => $product->getSeason()?->getSeason()?->getSeason(),
                    'Numeric Size' => $product->getNumericSize()?->getNumericSize()?->getNumericSize(),
                    'Generic Size' => $product->getGenericSize()?->getGenericSize()?->getGenericSize(),
                    'Pattern' => $product->getClothingPattern()?->getPattern()?->getPatternStyle(),
                    'Pattern' => $product->getClothingPattern()?->getPattern()?->getDesignStyle(),
                ];
            }
        }
 
        return $productData;
    }
 
    /**
     * Get products action.
     *
     * @Route("/api/get-products", name="authenticateRequest", methods={"GET"})
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    
     public function authenticateRequest(Request $request)
     {
        $token = $request->headers->get('token');
        $validated = $this->tokenService->validateToken($token);
        if(!is_bool($validated))
        {
            if(in_array($validated,$this->authorized)){
                return $this->getProductsAction($request);
            }
            else{
                return new JsonResponse([
                    'products' => [],
                    'success' => false,
                    'error' => "User not authorized"
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        else{
            return new JsonResponse([
                'products' => [],
                'success' => false,
                'error' => "Expired Token"
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
 
     }
 
     public function getProductsAction($productRequest): JsonResponse
     {
         try {
 
            // Retrieve optional parameters from the$productRequest.
            $offset = $productRequest->query->get('offset', 0);
            $limit = $productRequest->query->get('limit', 25);
            $searchParam = $productRequest->query->get('searchParam', null);
            $searchValue = $productRequest->query->get('searchValue', null);
            $language = $productRequest->query->get('lang', 'en');
            
            
            // Create a product listing object for fetching products.
            $products = new DataObject\Clothing\Listing;
            $products->setLocale($language);
            
 
            // Set optional parameters if provided.
            if (is_numeric($offset)) {
                $products->setOffset((int)$offset);
            }
 
            if (is_numeric($limit)) {
                $products->setLimit((int)$limit);
            }
            
            // Apply search conditions if search parameters are provided.
            if ($searchParam !== null && $searchValue !== null && in_array($searchParam, ['sku', 'productName'])) {
                if ($searchParam === 'sku') {
                    $products->setCondition("sku LIKE ?", ["%" . $searchValue . "%"]);
                } elseif ($searchParam === 'productName') {
                    $products->setCondition("productName LIKE ?", ["%" . $searchValue . "%"]);
                }
            }
          
            // Return JSON response with product information.
            return new JsonResponse([
                'products' => $this->listToAssoc($products, $language),
                'success' => true,
                
            ]);
                  
         } catch (\Exception $e) {
             // Return JSON response with error information in case of an exception.
             return new JsonResponse([
                 'products' => [],
                 'success' => false,
                 
             ], Response::HTTP_INTERNAL_SERVER_ERROR);
         }
     }
  
}