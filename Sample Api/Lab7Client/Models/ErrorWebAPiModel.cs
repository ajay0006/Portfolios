using System.ComponentModel.DataAnnotations;
namespace Lab7Client.Models
{
    public class ErrorWebAPiModel
    {
        [Display(Name = "Field Name")]
        public string? Element { get; set; }

        [Display(Name = "Error Message")]
        public string? Message { get; set; }
    }
}
