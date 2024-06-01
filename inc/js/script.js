// Function to fetch data for pie chart
function fetchChartData() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "./backend/chart_data.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        var data = JSON.parse(xhr.responseText);
        updatePieChart(data);
      } else {
        console.error("Failed to fetch chart data. Status: " + xhr.status);
      }
    }
  };
  xhr.send();
}

// Function to update pie chart 
function updatePieChart(data) {
  if (
    data &&
    typeof data === "object" &&
    "income" in data &&
    "expenses" in data
  ) {
    var ctx = document.getElementById("pieChart").getContext("2d");
    var myPieChart = new Chart(ctx, {
      type: "pie",
      data: {
        labels: ["Income", "Expenses"], // Removed "Total Amount" label
        datasets: [
          {
            data: [data.income, data.expenses],
            backgroundColor: ["rgb(1,198,90)" , "rgb(255,40,58)"],
            borderColor: ["rgb(1,198,90)", "rgb(255,40,58)"],
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: false,
        maintainAspectRatio: false,
        legend: {
          position: "right",
        },
      },
    });
  } else {
    console.error("Invalid chart data format.");
  }
}

document.addEventListener("DOMContentLoaded", function () {
  fetchChartData(); 
});


