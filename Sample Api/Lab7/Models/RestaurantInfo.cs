using System.ComponentModel.DataAnnotations;

namespace Lab7.Models
{
    public class RestaurantInfo
    {
        public int id { get; set; }

        [Display(Name = "Restaurant Name")]
        public string? name { get; set; }

        [Display(Name = "Summary")]
        public string? summary { get; set; }

        [Display(Name = "Food Type")]
        public string? foodType { get; set; }

        [Display(Name = "Rating")]
        public int rating { get; set; }

        [Display(Name = "Cost")]
        public int cost { get; set; }
        public Address? address { get; set; }
    }
}
