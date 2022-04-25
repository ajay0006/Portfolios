using System.Text.Json;

namespace Lab7Client.Models
{
    public class ErrorUtils
    {
        public static Dictionary<string, List<string>> ExtractErrorsFromWebApiResponse (string body)
        {
            var response = new Dictionary<string, List<string>> ();

            var jsonElement = JsonSerializer.Deserialize<JsonElement>(body);
            var errorsJsonElement = jsonElement.GetProperty ("errors");

            foreach (var fieldWithErrors in errorsJsonElement.EnumerateObject()) 
            {
                var field = fieldWithErrors.Name;
                var errors = new List<string> ();

                foreach (var errorKind in fieldWithErrors.Value.EnumerateArray())
                {
                    var error = errorKind.GetString ();
                    errors.Add(error);
                }

                response.Add (field, errors);
            }

            return response;
        }
    }
}
