using System.ComponentModel.DataAnnotations;

namespace Lab7Client.Models
{
    public class RestaurantInfo
    {
        public int Id { get; set; }

        [Display(Name = "Restaurant Name")]
        public string? Name { get; set; }

        [Display(Name = "Summary")]
        public string? Summary { get; set; }

        [Display(Name = "Food Type")]
        public string? FoodType { get; set; }

        [Display(Name = "Rating")]
        public int Rating { get; set; }

        [Display(Name = "Cost")]
        public int Cost { get; set; }
        public Address? Address { get; set; }
    }
}
