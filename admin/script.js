// Greeting Message
function setGreeting() {
  let hour = new Date().getHours();
  let greeting = "Good Evening, Admin";
  if (hour < 12) greeting = "Good Morning, Admin";
  else if (hour < 18) greeting = "Good Afternoon, Admin";
  document.getElementById("greeting").innerText = greeting;
}
setGreeting();

// Live Date & Time
function updateDateTime() {
  const now = new Date();
  document.getElementById("dateTime").innerText = now.toLocaleString();
}
setInterval(updateDateTime, 1000);

// Dark Mode Toggle
document.getElementById("darkModeBtn").addEventListener("click", () => {
  document.body.classList.toggle("dark-mode");
});

// Chart.js Example
const ctx = document.getElementById('myChart').getContext('2d');
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Users', 'Games', 'Queries'],
    datasets: [{
      label: 'Statistics',
      data: [120, 35, 18],
      backgroundColor: ['#3498db', '#2ecc71', '#e74c3c']
    }]
  }
});