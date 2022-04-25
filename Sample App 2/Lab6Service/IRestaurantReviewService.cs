using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.ServiceModel.Web;
using System.Text;

namespace Lab6Service
{
    // NOTE: You can use the "Rename" command on the "Refactor" menu to change the interface name "IService1" in both code and config file together.
    [ServiceContract]
    public interface IRestaurantReviewService
    {

        [OperationContract]
        List<string> GetRestaurantNames();

        [OperationContract]
        List<RestaurantInfo> GetAllRestaurants();

        [OperationContract]
        RestaurantInfo GetRestaurantById(int id);

        [OperationContract]
        RestaurantInfo SaveRestaurant(RestaurantInfo restaurantInfo);
        


        // TODO: Add your service operations here
    }


    // Use a data contract as illustrated in the sample below to add composite types to service operations.
    [DataContract]
    public class RestaurantInfo
    {
        [DataMember]

        public int? Id { get; set; }

        [DataMember]
        [Display(Name = "Restaurant Name")]
        public string Name { get; set; }

        [DataMember]
        [Display(Name = "Summary")]
        public string Summary { get; set; }

        [DataMember]
        [Display(Name = "Food Type")]
        public string FoodType { get; set; }

        [DataMember]
        [Display(Name = "Rating")]
        public int Rating { get; set; }

        [DataMember]
        [Display(Name = "Cost")]
        public int Cost { get; set; }

        [DataMember]
        public Address Address { get; set; }

    }

    [DataContract]
    public class Address
    {
        [DataMember]
        [Display(Name = "Street Address")]
        public string Street { get; set; }

        [DataMember]
        [Display(Name = "City")]
        public string City { get; set; }

        [DataMember]
        [Display(Name = "Province" )]
        public ProvinceType? Province { get; set; }

        [DataMember]
        [Display(Name = "Postal Code" )]
        public string PostalCode { get; set; }
    }
}
