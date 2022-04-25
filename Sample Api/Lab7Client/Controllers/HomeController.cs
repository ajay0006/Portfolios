using Lab7Client.Models;
using Microsoft.AspNetCore.Mvc;
using System.Diagnostics;
using System.Text.Json;
using System.Net;
using System.Text;

namespace Lab7Client.Controllers
{
    public class HomeController : Controller
    {
        private readonly ILogger<HomeController> _logger;
        private string serviceUrl = "http://localhost:5230/RestaurantReview";
        //private string serviceUrl = "http://localhost:8080/RestaurantReviewServiceApi/RestaurantReview";

        public HomeController(ILogger<HomeController> logger)
        {
            _logger = logger;
        }

        public IActionResult Index()
        {
            // using HttpClient httpclient = new Httpclient();
            HttpClient client = new();

            using var response = client.GetAsync(serviceUrl).Result;

            if (response.StatusCode == HttpStatusCode.OK)
            {
                string apiResponse = response.Content.ReadAsStringAsync().Result;

                var options = new JsonSerializerOptions
                {
                    PropertyNamingPolicy = JsonNamingPolicy.CamelCase,

                };

                List<RestaurantInfo> restaurantInfos = JsonSerializer.Deserialize<List<RestaurantInfo>>(apiResponse);
                return View(restaurantInfos);
            }

            else
            {
                return RedirectToAction("Error");
            }
        }

        [HttpGet]
        public IActionResult Edit(int Id)
        {
            if (Id.ToString() == null)
            {
                return NotFound();
            }

            else
            {
                HttpClient httpClient = new();
                using var response = httpClient.GetAsync(serviceUrl + "/" + Id).Result;

                if (response.StatusCode == HttpStatusCode.OK)
                {
                    string apiResponse = response.Content.ReadAsStringAsync().Result;
                    RestaurantInfo restaurantInfo = JsonSerializer.Deserialize<RestaurantInfo>(apiResponse);
                    return View(restaurantInfo);
                }

                else
                {
                    return RedirectToAction("Error");
                }
            }
        }

        [HttpPost]
        // public IActionResult Edit(RestaurantInfo restaurantInfo)
        public async Task<IActionResult> EditAsync(RestaurantInfo restaurantInfo)
        {
            HttpClient httpClient = new();
            var jsonRestaurantInfo = JsonSerializer.Serialize<RestaurantInfo>(restaurantInfo);
            List<ErrorWebAPiModel> errorWebAPiModel = new();
            ErrorWebAPiModel errorWebAPi = new();

            StringContent stringContent = new(jsonRestaurantInfo, Encoding.UTF8, "application/json");

            using var response = httpClient.PutAsync(serviceUrl, stringContent).Result;

            if (response.StatusCode == HttpStatusCode.OK)
            {
                return RedirectToAction("Index");
            }

            else
            {
                /*var body1 = response.Content.ReadAsStringAsync().Result;
                Console.WriteLine(body1);
                Console.WriteLine("--------------------------------");
                return RedirectToAction("Error");*/

                var body = await response.Content.ReadAsStringAsync();
                var errorsFromWebApi = ErrorUtils.ExtractErrorsFromWebApiResponse(body);

                foreach (var fieldWithErrors in errorsFromWebApi)
                {
                    Console.WriteLine($"-{fieldWithErrors.Key}");

                    foreach (var error in fieldWithErrors.Value)
                    {
                        Console.WriteLine($" {error} ");
                        errorWebAPi.Element = fieldWithErrors.Key;
                        errorWebAPi.Message = error;                                               
                    }

                    errorWebAPiModel.Add(errorWebAPi);
                }
               // return RedirectToAction("Error", errorsFromWebApi);
               return View("ErrorWebApi", errorWebAPiModel);
            }

        }

        public IActionResult Create()
        {
            HttpClient client = new();

            using var response = client.GetAsync(serviceUrl).Result;

            if (response.StatusCode == HttpStatusCode.OK)
            {
                string apiResponse = response.Content.ReadAsStringAsync().Result;

                List<RestaurantInfo> restaurantInfos = JsonSerializer.Deserialize<List<RestaurantInfo>>(apiResponse);
                int newId = restaurantInfos.Count + 1;
                TempData["id"] = newId;
                return View();
            }

            else
            {
                return RedirectToAction("Error");
            }

        }

        [HttpPost]
        public IActionResult Create(RestaurantInfo restaurantInfo)
        {
            HttpClient httpsClient = new();
            string jsonRestaurantInfo = JsonSerializer.Serialize<RestaurantInfo>(restaurantInfo);
            StringContent StringContent = new(jsonRestaurantInfo, Encoding.UTF8, "application/json");

            using var response = httpsClient.PostAsync(serviceUrl, StringContent).Result;

            if (response.StatusCode == HttpStatusCode.OK)
            {
                return RedirectToAction("Index");
            }

            else
            {
                return RedirectToAction("Error");
            }
        }



        [ResponseCache(Duration = 0, Location = ResponseCacheLocation.None, NoStore = true)]
        public IActionResult Error()
        {
            return View(new ErrorViewModel { RequestId = Activity.Current?.Id ?? HttpContext.TraceIdentifier });
        }
    }
}