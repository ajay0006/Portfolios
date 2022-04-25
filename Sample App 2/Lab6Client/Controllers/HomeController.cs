using Lab6Client.Models;
using Microsoft.AspNetCore.Mvc;
using RestaurantReviews;
using System.Diagnostics;

namespace Lab6Client.Controllers
{
    public class HomeController : Controller
    {
        private readonly ILogger<HomeController> _logger;

        public HomeController(ILogger<HomeController> logger)
        {
            _logger = logger;
        }

        public IActionResult Index()
        {
            RestaurantReviewServiceClient client = new();
            List<RestaurantInfo> restaurants = client.GetAllRestaurants();
            return View(restaurants);
        }

        public IActionResult Edit(int Id)
        {
            RestaurantReviewServiceClient client = new();
            RestaurantInfo restaurant = client.GetRestaurantById(Id);
            return View(restaurant);
        }

        [ValidateAntiForgeryToken]
        [HttpPost]
        public IActionResult Edit(RestaurantInfo restaurantInfo)
        {
            RestaurantReviewServiceClient client = new();
            client.SaveRestaurant(restaurantInfo);
            return RedirectToAction("Index");
        }

    }
}