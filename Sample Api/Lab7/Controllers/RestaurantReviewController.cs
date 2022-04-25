using Microsoft.AspNetCore.Mvc;
using Lab7.Models;
using System.Xml.Serialization;
using System.Collections.Generic;
using System.Xml;
using System.Text;
using System.Web;
using Microsoft.AspNetCore.Cors;
using System.Text.Json;

// For more information on enabling Web API for empty projects, visit https://go.microsoft.com/fwlink/?LinkID=397860

namespace Lab7.Controllers
{
    [EnableCors]
    [Route("[controller]")]
    [ApiController]
    public class RestaurantReviewController : ControllerBase
    {
        private readonly IWebHostEnvironment _webHostEnvironment;

        public RestaurantReviewController(IWebHostEnvironment webHostEnvironment)
        {
            _webHostEnvironment = webHostEnvironment;
        }

        // GET: api/<RestaurantReviewController>
        [HttpGet]
        public IActionResult? Get()
        {

            List<RestaurantInfo>? restaurantsInfo = new();
            List<Restaurant>? restaurants = GetAllRestaurantReviews(RootAttribute(), GetXmlFile());

            if (restaurants != null)
            {
                foreach (Restaurant restaurant in restaurants)
                {
                    restaurantsInfo.Add(new RestaurantInfo
                    {
                        id = Convert.ToInt32(restaurant.Id),
                        name = restaurant.Name,
                        foodType = restaurant.Type,
                        summary = restaurant.Reviews.Review.Summary.Replace("\n", "").Replace("\t", ""),
                        rating = (int)restaurant.Reviews.Review.Rating.Value,
                        cost = restaurant.Reviews.Review.Price_Rating.Value,
                        address = new Models.Address
                        {
                            street = restaurant.Address.Street,
                            city = restaurant.Address.City,
                            province = restaurant.Address.Province.ToString(),
                            postalCode = restaurant.Address.Postal_Code
                        }
                    });

                }
            }

            if (restaurantsInfo != null)
            {
                string jsonStringRestaurantInfo = JsonSerializer.Serialize<List<RestaurantInfo>>(restaurantsInfo);
                return Ok(jsonStringRestaurantInfo);
            }

            return null;

        }

        // GET api/<RestaurantReviewController>/5
        [HttpGet("{id}")]
        public IActionResult Get(int id)
        {
            List<Restaurant>? restaurants = GetAllRestaurantReviews(RootAttribute(), GetXmlFile());
            Restaurant? restaurant = restaurants?.Where(restaurant => restaurant.Id.Trim() == id.ToString().Trim().ToUpper()).FirstOrDefault();

            if (restaurant != null)
            {
                RestaurantInfo restaurantInfo = new()
                {
                    id = Convert.ToInt32(restaurant.Id),
                    name = restaurant.Name,
                    foodType = restaurant.Type,
                    summary = restaurant.Reviews.Review.Summary.Replace("\n", "").Replace("\t", ""),
                    rating = (int)restaurant.Reviews.Review.Rating.Value,
                    cost = restaurant.Reviews.Review.Price_Rating.Value,
                    address = new Models.Address
                    {
                        street = restaurant.Address.Street,
                        city = restaurant.Address.City,
                        province = restaurant.Address.Province.ToString(),
                        postalCode = restaurant.Address.Postal_Code
                    }

                };

                if (restaurantInfo != null)
                {
                    string jsonStringRestaurantInfo = JsonSerializer.Serialize<RestaurantInfo>(restaurantInfo);
                    return Ok(jsonStringRestaurantInfo);
                }

            }

            return NotFound($"id {id} does not exist");
        }

        [Route("[action]")]
        public List<string> GetRestaurantNames()
        {
            List<Restaurant>? restaurants = GetAllRestaurantReviews(RootAttribute(), GetXmlFile());
            List<string> names = new();

            if (restaurants != null)
            {
                restaurants.ForEach(restaurant => names.Add(restaurant.Name));
            }

            return names;
        }

        // POST api/<RestaurantReviewController>
        [HttpPost]
        public void Post([FromBody] RestaurantInfo jsonRestaurantInfo)
        {
            List<Restaurant>? restaurants = GetAllRestaurantReviews(RootAttribute(), GetXmlFile());
            if (jsonRestaurantInfo != null && restaurants != null)
            {
                // restaurants.Add(new Restaurant
                Restaurant restaurant = new()
                {
                    Id = jsonRestaurantInfo.id.ToString(),
                    Name = jsonRestaurantInfo.name,
                    Type = jsonRestaurantInfo.foodType,
                    Reviews = new Reviews
                    {
                        Review = new Review
                        {
                            Summary = jsonRestaurantInfo.summary,
                            Rating = new Rating
                            {
                                Value = jsonRestaurantInfo.rating
                            },
                            Price_Rating = new Price_Rating
                            {
                                Value = (byte)jsonRestaurantInfo.cost
                            }

                        }
                    },
                    Address = new Address
                    {
                        Street = jsonRestaurantInfo.address?.street,
                        City = jsonRestaurantInfo.address?.city,
                        Province = jsonRestaurantInfo.address.province,
                        Postal_Code = jsonRestaurantInfo.address?.postalCode,
                    }
                };

                if (restaurant != null && restaurants != null)
                {
                    restaurants.Add(restaurant);
                    SaveRestaurantsToXml(restaurants);
                }

            }

        }

        // PUT api/<RestaurantReviewController>/5
        [HttpPut]
        public void Put([FromBody] RestaurantInfo jSonRestaurantInfo)
        {
            List<Restaurant>? restaurants = GetAllRestaurantReviews(RootAttribute(), GetXmlFile());
            //string jSonrestaurantInfo2 = null;

            if (jSonRestaurantInfo != null)
            {
                //RestaurantInfo? restaurantInfo = JsonSerializer.Deserialize<RestaurantInfo>(jSonRestaurantInfo);

                foreach (Restaurant restaurant in restaurants.Where(r => r.Id.Trim() == jSonRestaurantInfo.id.ToString().Trim().ToUpper()))
                {
                    restaurant.Id = jSonRestaurantInfo.id.ToString();
                    restaurant.Name = jSonRestaurantInfo.name;
                    restaurant.Type = jSonRestaurantInfo.foodType;
                    restaurant.Reviews.Review.Summary = jSonRestaurantInfo.summary;
                    restaurant.Reviews.Review.Rating.Value = jSonRestaurantInfo.rating;
                    restaurant.Reviews.Review.Price_Rating.Value = (byte)jSonRestaurantInfo.cost;
                    restaurant.Address = new Address
                    {
                        City = jSonRestaurantInfo.address.city,
                        Street = jSonRestaurantInfo.address.street,
                        Postal_Code = jSonRestaurantInfo.address.postalCode,
                        Province = jSonRestaurantInfo.address.province,
                    };
                }

                SaveRestaurantsToXml(restaurants);
            }
        }

        // DELETE api/<RestaurantReviewController>/5
        [HttpDelete("{id}")]
        public void Delete(int id)
        {
            if (id.ToString() != null)
            {
                List<Restaurant>? restaurants = GetAllRestaurantReviews(RootAttribute(), GetXmlFile());
                if (restaurants != null)
                {
                    restaurants.RemoveAt(id - 1);
                    SaveRestaurantsToXml(restaurants);
                }
            }
        }

        private protected string GetXmlFile()
        {

            string[] filepaths = Directory.GetFiles(Path.Combine(_webHostEnvironment.WebRootPath, "Data/"));

            string fileName = Path.GetFileName(filepaths[1]);

            string xmlPath = Path.Combine(_webHostEnvironment.WebRootPath, "Data", fileName);
            return xmlPath;

        }
        private protected static XmlRootAttribute RootAttribute()
        {
            XmlRootAttribute root = new()
            {
                ElementName = "Restaurants",
                Namespace = "http://www.algonquincollege.com/cst8259/labs",
                IsNullable = false
            };
            return root;
        }

        // xml writer settings
        private protected static XmlWriterSettings SettingsXmlWriter()
        {
            XmlWriterSettings settings = new()
            {
                CheckCharacters = true,
                Encoding = Encoding.Unicode
            };
            return settings;
        }

        public static List<Restaurant>? GetAllRestaurantReviews(XmlRootAttribute xmlRootAttribute, string xmlPath)
        {
            List<Restaurant>? restaurants = null;
            using (FileStream fs = new(xmlPath, FileMode.Open))
            {
                XmlSerializer xmlSerializer = new(typeof(List<Restaurant>), xmlRootAttribute);
                restaurants = (List<Restaurant>?)xmlSerializer.Deserialize(fs);
            }
            return restaurants;
        }

        public void SaveRestaurantsToXml(List<Restaurant> restaurants)
        {
            XmlSerializer serializer = new(typeof(List<Restaurant>), RootAttribute());
            XmlWriter xmlWriter = XmlWriter.Create(GetXmlFile());
            serializer.Serialize(xmlWriter, restaurants);
            xmlWriter.Close();
        }


    }
}