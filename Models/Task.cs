namespace Elektronet.Models;

public class Task
{
    public int Id { get; set; }
    public int? AssignedEmployeeId { get; set; }
    public int ReportedByEmployeeId { get; set; }
    public string Room { get; set; }
    public string Text { get; set; }
    public string Status { get; set; }
    public string? Priority { get; set; }
    public DateTime Date { get; set; }
}