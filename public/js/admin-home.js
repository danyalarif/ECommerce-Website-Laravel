const color = 'rgb(255, 99, 132)';
var weeklyProfit = document.getElementById("weekly-sale");
const chartID = 'ps-chart';

var spinner = 
'<tr>'+
    '<td colspan = "7">'+
        '<div class="d-flex justify-content-center">'+
            '<div class="spinner-grow text-danger" role="status">'+
                '<span class="sr-only">Loading...</span>'+
            '</div>'+
        '</div>'+
    '</td>'+
'</tr>';


const chartBody = document.getElementById(chartID);

chartBody.addEventListener("load", loadChart())

function makeChart(chartObj, valuesArray, labelsArray){
  //Data of Chart
  const data = {
    labels: labelsArray,
    datasets: [{
      label: 'Product Sale',
      backgroundColor: color,
      borderColor: color,
      data: valuesArray,
      fill: {
        target: 'origin',
        above: color,
      },
      lineTension: 0.4
    }]
  };
  //Configuration of Chart
  const config = {
    type: 'line',
    data: data,
    options: {
        scales: {
            x: {
              grid: {
                color: 'white',
                borderColor: 'black'
              }
            },
            y: {
                grid: {
                  color: 'white',
                  borderColor: 'black'
                },
              }
        }
    }
  };
  const myChart = new Chart(
    chartObj,
    config
  );
}

function totalProfit(valuesArray){
  amount = 0;
  for(var i = 0; i<valuesArray.length ; i++){
    amount = amount+parseInt(valuesArray[i]);
  }
  return amount;
}

function loadChart(){
  const xhr = new XMLHttpRequest();
  xhr.open('GET', '/get-weekly-profit', true);
  xhr.onprogress = function(){
    chartBody.innerHTML = spinner;
  }
  xhr.onload = function(){
      let data = JSON.parse(this.responseText);
      let chartInnerBody = "";
      var labels = []
      var values = []
      for(key in data){
        daySale = data[data.length-1-key];
        labels.push(daySale.day);
        values.push(daySale.productSale);
      }
      makeChart(chartBody, values, labels);

      var profit = totalProfit(values);
      weeklyProfit.innerHTML = "Rs. " + (profit/1000000).toFixed(2) + "M";
  }
  xhr.send();
}