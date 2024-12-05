<div class="row text-center">
    <div class="col-lg-2 col-md-4 mb-4">
      <div class="card dash p-4">
        <h6 class="text-dark">Total Machines</h6>
        <p class="stat-number text-primary">122</p>
      </div>
    </div>
    <div class="col-lg-2 col-md-4 mb-4">
      <div class="card dash p-4">
        <h6 class="text-dark">Windows Machines</h6>
        <p class="stat-number text-success">121</p>
      </div>
    </div>
    <div class="col-lg-2 col-md-4 mb-4">
      <div class="card dash p-4">
        <h6 class="text-dark">Unix Machines</h6>
        <p class="stat-number text-danger">1</p>
      </div>
    </div>
    <div class="col-lg-2 col-md-4 mb-4">
      <div class="card dash p-4">
        <h6 class="text-dark">Android</h6>
        <p class="stat-number text-danger">1</p>
      </div>
    </div>
    <div class="col-lg-2 col-md-4 mb-4">
      <div class="card dash p-4">
        <h6 class="text-dark">System</h6>
        <p class="stat-number text-danger">1</p>
      </div>
    </div>
    <div class="col-lg-2 col-md-4 mb-4">
      <div class="card dash p-4">
        <h6 class="text-dark">Software</h6>
        <p class="stat-number text-warning">6683</p>
      </div>
    </div>
  </div>

  <!-- Daily Statistics Row -->
  <div class="row text-center">
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card dash p-4">
        <h6 class="text-dark">Machines Contacted Today</h6>
        <p class="stat-number text-primary">58</p>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card dash p-4">
        <h6 class="text-dark">Windows Contacted</h6>
        <p class="stat-number text-success">57</p>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card dash p-4">
        <h6 class="text-dark">Unix Contacted</h6>
        <p class="stat-number text-danger">1</p>
      </div>
    </div>
  </div>

  <!-- Chart and Stats Row with Two Identical Cards -->
  <div class="row justify-content-center text-center">
    <div class="col-lg-4 col-md-6 mb-4"> 
      <div class="card dash p-3">
        <h6 class="text-center mb-3 text-dark">Agent Breakdown</h6>
        <div class="chart-container">
          <canvas id="agentChart1"></canvas>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4"> 
      <div class="card dash p-3">
        <h6 class="text-center mb-3 text-dark">Agent Breakdown</h6>
        <div class="chart-container">
          <canvas id="agentChart2"></canvas>
        </div>
      </div>
    </div>
</div>

  <!-- New Line Chart Card -->
  <div class="row">
    <div class="col-lg-12 mb-4">
      <div class="card dash p-3">
        <h6 class="text-center mb-3 text-dark ">Monthly Machine Contacts</h6>
        <div class="chart-container">
          <canvas id="lineChart"></canvas>
        </div>
      </div>
    </div>
  </div>

</div>