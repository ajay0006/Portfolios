using System.ComponentModel.DataAnnotations;

namespace Lab7Client.Models
{
    public class Address
    {

        [Display(Name = "Street Address")]
        public string? Street { get; set; }

        [Display(Name = "City")]
        public string? City { get; set; }

        [Display(Name = "Province")]
        public ProvinceType Province { get; set; }

        [Display(Name = "Postal Code")]
        public string? PostalCode { get; set; }
    }
}
