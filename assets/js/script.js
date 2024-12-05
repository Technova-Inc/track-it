// Pourcentage de stockage libre initial (par exemple, 100%)
let percentage = 80;

// Fonction pour mettre à jour le pourcentage et l'arc
function updateStorage(newPercentage) {
  percentage = newPercentage;
  
  // Calculer l'offset pour le demi-arc (propriétés du demi-cercle)
  let strokeDasharray = 251;  // La longueur du demi-cercle (pi * r)
  let strokeDashoffset = (1 - (percentage / 100)) * strokeDasharray;

  // Appliquer l'offset au demi-arc
  document.getElementById("storage-arc").style.strokeDashoffset = strokeDashoffset;

  // Afficher le pourcentage dans le texte
  document.getElementById("percentage-text").textContent = percentage + "%";
}

// Initialiser avec le pourcentage de 100%
updateStorage(percentage);

// First chart data (Agent Breakdown 1)
const ctx1 = document.getElementById('agentChart1').getContext('2d');
new Chart(ctx1, {
  type: 'doughnut',
  data: {
    labels: ['Windows Agent', 'Mac Agent', 'Unix Agent'],
    datasets: [{
      data: [90, 5, 5], // Example data
      backgroundColor: ['#8a2be2', '#6c757d', '#dc3545'], // Violet, Grey, Red
      borderWidth: 1,
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: 'bottom',
      }
    }
  }
});

// Second chart data (Agent Breakdown 2)
const ctx2 = document.getElementById('agentChart2').getContext('2d');
new Chart(ctx2, {
  type: 'doughnut',
  data: {
    labels: ['Windows Agent', 'Mac Agent', 'Unix Agent'],
    datasets: [{
      data: [80, 10, 10], // Example data
      backgroundColor: ['#8a2be2', '#6c757d', '#dc3545'], // Violet, Grey, Red
      borderWidth: 1,
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: 'bottom',
      }
    }
  }
});

// Line chart data (Monthly Machine Contacts)
const ctx3 = document.getElementById('lineChart').getContext('2d');
new Chart(ctx3, {
  type: 'line',
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], // Monthly labels
    datasets: [{
      label: 'Machines Contacted',
      data: [50, 75, 60, 80, 90, 95, 100, 110, 105, 120, 130, 140], // Example monthly data
      fill: false,
      borderColor: '#8a2be2', // Green color
      tension: 0.1,
      borderWidth: 2
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});