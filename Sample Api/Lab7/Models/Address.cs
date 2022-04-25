using System.ComponentModel.DataAnnotations;

namespace Lab7.Models
{
    public class Address
    {

        [Display(Name = "Street Address")]
        public string? street { get; set; }

        [Display(Name = "City")]
        public string? city { get; set; }

        [Display(Name = "Province")]
        public string? province { get; set; }

        [Display(Name = "Postal Code")]
        public string? postalCode { get; set; }
    }
}
