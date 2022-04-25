using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.ServiceModel.Web;
using System.Text;
using System.Web;
using System.Xml;
using System.Xml.Serialization;

namespace Lab6Service
{
    // NOTE: You can use the "Rename" command on the "Refactor" menu to change the class name "Service1" in code, svc and config file together.
    // NOTE: In order to launch WCF Test Client for testing this service, please select Service1.svc or Service1.svc.cs at the Solution Explorer and start debugging.
    public class RestaurantReviewService : IRestaurantReviewService
    {
        static readonly string xmlFilePath = HttpContext.Current.Server.MapPath("~/App_Data/Practice.xml");


        public List<string> GetRestaurantNames()
        {
            List<string> restaurantNames = new List<string>();
            List<Restaurant> allRestaurants = GetRestaurantsFromXml(RootAttribute());

            if (allRestaurants != null)
            {
                foreach (Restaurant restaurant in allRestaurants)
                {
                    restaurantNames.Add(restaurant.Name.Replace("\n", "").Replace("\t", ""));
                }
            }

            else
            {
                return null;
            }
            return restaurantNames;
        }

        List<RestaurantInfo> IRestaurantReviewService.GetAllRestaurants()
        {
            List<Restaurant> allRestaurants = GetRestaurantsFromXml(RootAttribute());
            List<RestaurantInfo> allRestaurantInfos = new List<RestaurantInfo>();

            foreach (Restaurant restaurant in allRestaurants)
            {
                allRestaurantInfos.Add(new RestaurantInfo
                {
                    Id = restaurant.Id,
                    Name = restaurant.Name,
                    Summary = restaurant.Reviews.Review.Summary,
                    Cost = (int)restaurant.Reviews.Review.Rating.Value,
                    Rating = restaurant.Reviews.Review.Price_Rating.Value,
                    FoodType = restaurant.Type,
                    Address = new Address
                    {
                        Street = restaurant.Address.Street,
                        City = restaurant.Address.City,
                        Province = restaurant.Address.Province,
                        PostalCode = restaurant.Address.Postal_Code

                    }

                });
            }
            return allRestaurantInfos;

        }

        RestaurantInfo IRestaurantReviewService.GetRestaurantById(int id)
        {
            RestaurantInfo restaurantInfo = new RestaurantInfo();
            List<Restaurant> allRestaurant = GetRestaurantsFromXml(RootAttribute());
            Restaurant restaurant = null;

            if (id.ToString() != null)
            {
                restaurant = allRestaurant.Find(r => r.Id == id);
                if (restaurant != null)
                {
                    restaurantInfo.Id = restaurant.Id;
                    restaurantInfo.Name = restaurant.Name;
                    restaurantInfo.Summary = restaurant.Reviews.Review.Summary;
                    restaurantInfo.Rating = (int)restaurant.Reviews.Review.Rating.Value;
                    restaurantInfo.Address = new Address
                    {
                        Street = restaurant.Address.Street,
                        City = restaurant.Address.City,
                        Province = restaurant.Address.Province,
                        PostalCode = restaurant.Address.Postal_Code
                    };

                }
            }

            return restaurantInfo;
        }

        RestaurantInfo IRestaurantReviewService.SaveRestaurant(RestaurantInfo restaurantInfo)
        {
            if (restaurantInfo.Id.ToString() != null)
            {
                List<Restaurant> allRestaurants = GetRestaurantsFromXml(RootAttribute());

                foreach (Restaurant restaurant in allRestaurants.Where(r => r.Id == restaurantInfo.Id))
                {
                    restaurant.Name = restaurantInfo.Name;
                    restaurant.Address = new global::Address
                    {
                        City = restaurantInfo.Address.City,
                        Street = restaurantInfo.Address.Street,
                        Postal_Code = restaurantInfo.Address.PostalCode,
                        Province = restaurantInfo.Address.Province,

                    };
                    restaurant.Reviews.Review.Summary = restaurantInfo.Summary;
                    restaurant.Type = restaurantInfo.FoodType;
                    restaurant.Reviews.Review.Rating.Value = restaurantInfo.Rating;
                    restaurant.Reviews.Review.Price_Rating.Value = (byte)restaurantInfo.Cost;
                }


                XmlSerializer serializer = new XmlSerializer(typeof(List<Restaurant>), RootAttribute());
                XmlWriter xmlWriter = XmlWriter.Create(xmlFilePath, SettingsXmlWriter());
                serializer.Serialize(xmlWriter, allRestaurants);
                xmlWriter.Close();
            }

            return null;

        }

        private protected static XmlRootAttribute RootAttribute()
        {
            XmlRootAttribute root = new XmlRootAttribute
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
            XmlWriterSettings settings = new XmlWriterSettings
            {
                CheckCharacters = true,
                Encoding = Encoding.Unicode
            };
            return settings;
        }

        public static List<Restaurant> GetRestaurantsFromXml(XmlRootAttribute xmlRootAttribute)
        {
            List<Restaurant> restaurants = null;

            using (FileStream fs = new FileStream(xmlFilePath, FileMode.Open))
            {
                XmlSerializer xmlSerializer = new XmlSerializer(typeof(List<Restaurant>), xmlRootAttribute);
                restaurants = (List<Restaurant>)xmlSerializer.Deserialize(fs);

            }

            return restaurants;
        }
    }
}
