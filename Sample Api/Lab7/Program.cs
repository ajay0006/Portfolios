var builder = WebApplication.CreateBuilder(args);


// Add services to the container.

builder.Services.AddCors(options =>
{
    options.AddDefaultPolicy(
        builder =>
        {
            builder.AllowAnyOrigin().AllowAnyMethod().AllowAnyHeader();
        });
});

builder.Services.AddControllers();

var app = builder.Build();

// Configure the HTTP request pipeline.

app.UseRouting();
app.UseCors();
app.UseAuthorization();
app.UseEndpoints(endpoints =>
{
    endpoints.MapControllers();
});

app.UseStaticFiles();


if (builder.Environment.IsDevelopment())
{
    app.UseDeveloperExceptionPage();
};
app.MapControllers();

app.Run();
