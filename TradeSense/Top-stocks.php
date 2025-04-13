<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TradeSense</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }
    
    body {
      min-height: 100vh;
      background: linear-gradient(to bottom right, #0f172a, #1e293b);
      color: #f8fafc;
    }
    
    .dashboard {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    
    /* Header Styles */
    header {
      position: sticky;
      top: 0;
      z-index: 50;
      background-color: rgba(15, 23, 42, 0.8);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(51, 65, 85, 0.4);
      padding: 1rem 0;
    }
    
    .header-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 1rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .brand {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .brand-icon {
      color: #10b981;
      width: 24px;
      height: 24px;
    }
    
    .brand-name {
      background: linear-gradient(to right, #10b981, #14b8a6);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      font-size: 1.25rem;
      font-weight: 700;
    }
    
    .header-actions {
      display: flex;
      align-items: center;
      gap: 1rem;
    }
    
    .avatar-button {
      width: 2.5rem;
      height: 2.5rem;
      border-radius: 9999px;
      background-color: #64748b;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      color: white;
      cursor: pointer;
      transition: all 0.2s;
      border: 2px solid transparent;
    }
    
    .avatar-button:hover {
      border-color: #10b981;
      transform: scale(1.05);
    }
    
    .search-container {
      position: relative;
      max-width: 400px;
      width: 100%;
      display: none;
    }
    
    @media (min-width: 768px) {
      .search-container {
        display: block;
      }
    }
    
    .search-input {
      width: 100%;
      padding: 0.5rem 0.5rem 0.5rem 2rem;
      background-color: rgba(30, 41, 59, 0.5);
      border: 1px solid #334155;
      border-radius: 0.375rem;
      color: #f1f5f9;
      font-size: 0.875rem;
    }
    
    .search-icon {
      position: absolute;
      left: 0.75rem;
      top: 50%;
      transform: translateY(-50%);
      color: #64748b;
      width: 16px;
      height: 16px;
    }
    
    .search-input:focus {
      outline: none;
      border-color: #10b981;
      box-shadow: 0 0 0 1px rgba(16, 185, 129, 0.1);
    }
    
    .logout-button {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      background-color: transparent;
      border: none;
      color: #e2e8f0;
      font-size: 0.875rem;
      cursor: pointer;
      padding: 0.5rem;
      border-radius: 0.375rem;
      transition: background-color 0.15s ease;
    }
    
    .logout-button:hover {
      background-color: rgba(51, 65, 85, 0.5);
    }
    
    .logout-icon {
      width: 18px;
      height: 18px;
    }
    
    .logout-text {
      display: none;
    }
    
    @media (min-width: 640px) {
      .logout-text {
        display: inline;
      }
    }
    
    /* Main Content Styles */
    main {
      flex: 1;
      max-width: 1280px;
      width: 100%;
      margin: 0 auto;
      padding: 1.5rem 1rem;
    }
    
    .api-error {
      margin-bottom: 1.5rem;
      padding: 1rem;
      background-color: rgba(239, 68, 68, 0.2);
      border: 1px solid rgba(239, 68, 68, 0.5);
      border-radius: 0.5rem;
    }
    
    .api-error-title {
      color: #f87171;
      font-weight: 500;
      margin-bottom: 0.25rem;
    }
    
    .api-error-message {
      color: #e2e8f0;
      font-size: 0.875rem;
    }
    
    .api-error-note {
      color: #94a3b8;
      font-size: 0.75rem;
      margin-top: 0.25rem;
    }
    
    /* Market Overview Styles */
    .market-overview {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
      margin-bottom: 2rem;
    }
    
    @media (min-width: 640px) {
      .market-overview {
        grid-template-columns: repeat(3, 1fr);
      }
    }
    
    @media (min-width: 1024px) {
      .market-overview {
        grid-template-columns: repeat(6, 1fr);
      }
    }
    
    .market-card {
      background-color: rgba(30, 41, 59, 0.5);
      border: 1px solid #334155;
      border-radius: 0.5rem;
      overflow: hidden;
    }
    
    .market-card-header {
      padding: 0.75rem 0.75rem 0.5rem;
    }
    
    .market-card-label {
      font-size: 0.75rem;
      font-weight: 500;
      color: #94a3b8;
    }
    
    .market-card-content {
      padding: 0 0.75rem 0.75rem;
    }
    
    .market-card-value {
      font-size: 1.125rem;
      font-weight: 600;
    }
    
    .market-card-change {
      display: flex;
      align-items: center;
      font-size: 0.75rem;
      margin-top: 0.25rem;
    }
    
    .change-positive {
      color: #10b981;
    }
    
    .change-negative {
      color: #ef4444;
    }
    
    .change-icon {
      width: 12px;
      height: 12px;
      margin-left: 0.25rem;
    }
    
    /* Dashboard Grid Styles */
    .dashboard-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 1.5rem;
      margin-bottom: 2rem;
    }
    
    @media (min-width: 1024px) {
      .dashboard-grid {
        grid-template-columns: 1fr 3fr;
      }
    }
    
    .card {
      background-color: rgba(30, 41, 59, 0.5);
      border: 1px solid #334155;
      border-radius: 0.5rem;
      overflow: hidden;
    }
    
    .card-header {
      padding: 1rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .card-title {
      font-size: 1.125rem;
      font-weight: 600;
    }
    
    .card-content {
      padding: 0;
      max-height: 400px;
      overflow: auto;
    }
    
    .card-content::-webkit-scrollbar {
      width: 8px;
    }
    
    .card-content::-webkit-scrollbar-track {
      background: rgba(15, 23, 42, 0.2);
    }
    
    .card-content::-webkit-scrollbar-thumb {
      background-color: rgba(51, 65, 85, 0.5);
      border-radius: 4px;
    }
    
    /* Top Market Stocks List */
    .stocks-list {
      list-style: none;
      padding: 0;
      margin: 0;
      border-top: 1px solid #1e293b;
    }
    
    .stock-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0.75rem 1rem;
      cursor: pointer;
      border-bottom: 1px solid #1e293b;
      transition: background-color 0.15s ease;
    }
    
    .stock-item:hover {
      background-color: rgba(51, 65, 85, 0.3);
    }
    
    .stock-item.selected {
      background-color: rgba(16, 185, 129, 0.1);
    }
    
    .stock-info {
      display: flex;
      flex-direction: column;
    }
    
    .stock-symbol {
      font-weight: 500;
    }
    
    .stock-name {
      font-size: 0.75rem;
      color: #94a3b8;
    }
    
    .stock-price {
      text-align: right;
    }
    
    .stock-current {
      font-weight: 500;
    }
    
    .stock-change {
      font-size: 0.75rem;
    }
    
    .stock-actions {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    /* Buy Button */
    .buy-button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.25rem;
      background-color: rgba(16, 185, 129, 0.2);
      color: #10b981;
      border: 1px solid rgba(16, 185, 129, 0.5);
      border-radius: 0.375rem;
      padding: 0.25rem 0.5rem;
      font-size: 0.75rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    
    .buy-button:hover {
      background-color: rgba(16, 185, 129, 0.3);
    }
    
    .buy-icon {
      width: 12px;
      height: 12px;
    }
    
    /* Enhanced Chart Styles */
    .chart-container {
      height: 400px;
      width: 100%;
      padding: 1rem;
      position: relative;
    }
    
    .interactive-chart {
      width: 100%;
      height: 100%;
      overflow: hidden;
      border-radius: 0.5rem;
      background-color: rgba(15, 23, 42, 0.2);
    }
    
    .chart-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
    }
    
    .chart-grid line {
      stroke: rgba(51, 65, 85, 0.5);
      stroke-width: 1;
      stroke-dasharray: 3, 3;
    }
    
    .chart-grid path {
      stroke: none;
    }
    
    .chart-axis text {
      fill: #94a3b8;
      font-size: 10px;
    }
    
    .chart-axis line, .chart-axis path {
      stroke: rgba(51, 65, 85, 0.8);
    }
    
    .chart-area {
      fill-opacity: 0.2;
    }
    
    .chart-line {
      stroke-width: 2;
    }
    
    .chart-dot {
      fill: #fff;
      stroke-width: 2;
    }
    
    .chart-tooltip {
      position: absolute;
      background-color: rgba(15, 23, 42, 0.95);
      border: 1px solid #334155;
      border-radius: 0.375rem;
      padding: 0.75rem;
      pointer-events: none;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
      min-width: 150px;
      transform: translate(-50%, -120%);
      z-index: 10;
      opacity: 0;
      transition: opacity 0.2s ease;
    }
    
    .chart-tooltip.active {
      opacity: 1;
    }
    
    .chart-tooltip::after {
      content: '';
      position: absolute;
      bottom: -6px;
      left: 50%;
      transform: translateX(-50%);
      border-left: 6px solid transparent;
      border-right: 6px solid transparent;
      border-top: 6px solid #334155;
    }
    
    .tooltip-date {
      color: #94a3b8;
      font-size: 0.75rem;
      margin-bottom: 0.5rem;
    }
    
    .tooltip-price {
      font-size: 1.125rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }
    
    .tooltip-change {
      display: flex;
      align-items: center;
      gap: 0.25rem;
      font-size: 0.75rem;
    }
    
    .chart-controls {
      display: flex;
      gap: 0.5rem;
      margin-bottom: 1rem;
    }
    
    .chart-period-button {
      padding: 0.375rem 0.75rem;
      font-size: 0.75rem;
      background-color: rgba(30, 41, 59, 0.5);
      border: 1px solid #334155;
      border-radius: 0.375rem;
      color: #94a3b8;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    
    .chart-period-button:hover {
      background-color: rgba(51, 65, 85, 0.5);
      color: #e2e8f0;
    }
    
    .chart-period-button.active {
      background-color: rgba(16, 185, 129, 0.2);
      border-color: rgba(16, 185, 129, 0.5);
      color: #10b981;
    }
    
    .loading-spinner {
      width: 3rem;
      height: 3rem;
      border: 0.25rem solid rgba(51, 65, 85, 0.5);
      border-left-color: #10b981;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }
    
    /* Gainers and Losers Tables */
    .section-heading {
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 1.25rem;
      font-weight: 700;
      margin-bottom: 1rem;
    }
    
    .section-left {
      display: flex;
      align-items: center;
    }
    
    .section-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 1.25rem;
      height: 1.25rem;
      border-radius: 9999px;
      font-size: 0.75rem;
      margin-left: 0.5rem;
    }
    
    .section-badge.positive {
      background-color: rgba(16, 185, 129, 0.2);
      color: #10b981;
    }
    
    .section-badge.negative {
      background-color: rgba(239, 68, 68, 0.2);
      color: #ef4444;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
    }
    
    thead {
      background-color: rgba(15, 23, 42, 0.3);
      border-bottom: 1px solid #334155;
    }
    
    th {
      text-align: left;
      padding: 0.75rem 1rem;
      font-size: 0.75rem;
      font-weight: 500;
      color: #94a3b8;
    }
    
    td {
      padding: 0.75rem 1rem;
      border-bottom: 1px solid #1e293b;
    }
    
    tr:last-child td {
      border-bottom: none;
    }
    
    tr {
      transition: background-color 0.15s ease;
    }
    
    tbody tr:hover {
      background-color: rgba(51, 65, 85, 0.3);
      cursor: pointer;
    }
    
    .stocks-table-symbol {
      font-weight: 600;
    }
    
    .stocks-table-name {
      font-size: 0.75rem;
      color: #94a3b8;
      margin-top: 0.25rem;
      max-width: 150px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    
    /* Buy Modal */
    .modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 100;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s ease;
    }
    
    .modal.active {
      opacity: 1;
      pointer-events: auto;
    }
    
    .modal-content {
      background-color: #1e293b;
      border: 1px solid #334155;
      border-radius: 0.5rem;
      width: 100%;
      max-width: 28rem;
      overflow: hidden;
    }
    
    .modal-header {
      padding: 1rem;
      border-bottom: 1px solid #334155;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .modal-title {
      font-size: 1.125rem;
      font-weight: 600;
    }
    
    .modal-close {
      background: none;
      border: none;
      color: #94a3b8;
      cursor: pointer;
      width: 1.5rem;
      height: 1.5rem;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: color 0.2s ease;
    }
    
    .modal-close:hover {
      color: #f1f5f9;
    }
    
    .modal-body {
      padding: 1rem;
    }
    
    .form-group {
      margin-bottom: 1rem;
    }
    
    .form-label {
      display: block;
      font-size: 0.875rem;
      font-weight: 500;
      color: #94a3b8;
      margin-bottom: 0.5rem;
    }
    
    .form-control {
      width: 100%;
      padding: 0.5rem;
      background-color: #0f172a;
      border: 1px solid #334155;
      border-radius: 0.375rem;
      color: #f1f5f9;
      font-size: 0.875rem;
    }
    
    .form-control:focus {
      outline: none;
      border-color: #10b981;
      box-shadow: 0 0 0 1px rgba(16, 185, 129, 0.1);
    }
    
    .form-control:disabled {
      opacity: 0.7;
      cursor: not-allowed;
    }
    
    .modal-footer {
      padding: 1rem;
      border-top: 1px solid #334155;
      display: flex;
      justify-content: flex-end;
      gap: 0.5rem;
    }
    
    .btn {
      padding: 0.5rem 1rem;
      border-radius: 0.375rem;
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    
    .btn-secondary {
      background-color: transparent;
      border: 1px solid #475569;
      color: #e2e8f0;
    }
    
    .btn-secondary:hover {
      background-color: rgba(71, 85, 105, 0.2);
    }
    
    .btn-primary {
      background-color: #10b981;
      border: 1px solid #10b981;
      color: white;
    }
    
    .btn-primary:hover {
      background-color: #0ea573;
    }
    
    /* Footer Styles */
    footer {
      background-color: rgba(15, 23, 42, 0.8);
      backdrop-filter: blur(12px);
      border-top: 1px solid rgba(51, 65, 85, 0.4);
      padding: 1.5rem 0;
    }
    
    .footer-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 1rem;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    
    @media (min-width: 768px) {
      .footer-container {
        flex-direction: row;
        justify-content: space-between;
      }
    }
    
    .footer-copyright {
      font-size: 0.75rem;
      color: #64748b;
    }
    
    .footer-links {
      display: flex;
      gap: 1rem;
      margin-top: 1rem;
    }
    
    @media (min-width: 768px) {
      .footer-links {
        margin-top: 0;
      }
    }
    
    .footer-link {
      font-size: 0.75rem;
      color: #64748b;
      text-decoration: none;
      transition: color 0.15s ease;
    }
    
    .footer-link:hover {
      color: #94a3b8;
    }
    
    .footer-separator {
      color: #475569;
    }
  </style>
</head>
<body>
  <div class="dashboard">
    <!-- Header -->
    <header>
      <div class="header-container">
        <div class="brand">
          <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
            <polyline points="16 7 22 7 22 13"></polyline>
          </svg>
          <h1 class="brand-name">TradeSense</h1>
        </div>
        
        <div class="search-container">
          <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
          <input type="search" class="search-input" placeholder="Search for stocks..." id="stockSearch">
        </div>
        
        <div class="header-actions">
          <a href="dashboard.html" class="avatar-button" title="Go to Dashboard">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="3" y1="9" x2="21" y2="9"></line>
              <line x1="9" y1="21" x2="9" y2="9"></line>
            </svg>
          </a>
          
          <button class="logout-button">
            <svg class="logout-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
              <polyline points="16 17 21 12 16 7"></polyline>
              <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
            <span class="logout-text">Logout</span>
          </button>
        </div>
      </div>
    </header>
    
    <main>
      <!-- API Error Alert -->
      <div id="apiError" class="api-error" style="display: none;">
        <h3 class="api-error-title">API Error:</h3>
        <p class="api-error-message" id="apiErrorMessage">Finnhub API has reached its rate limit. Try again later.</p>
        <p class="api-error-note">Note: Using fallback data where needed.</p>
      </div>
      
      <!-- Market Overview -->
      <div class="market-overview">
        <div class="market-card">
          <div class="market-card-header">
            <div class="market-card-label">Market</div>
          </div>
          <div class="market-card-content">
            <div class="market-card-value" id="marketStatus">Loading...</div>
          </div>
        </div>
        
        <div class="market-card">
          <div class="market-card-header">
            <div class="market-card-label">Leader</div>
          </div>
          <div class="market-card-content">
            <div class="market-card-value" id="marketLeader">Loading...</div>
          </div>
        </div>
        
        <div class="market-card">
          <div class="market-card-header">
            <div class="market-card-label">Hottest Sector</div>
          </div>
          <div class="market-card-content">
            <div class="market-card-value" id="hottestSector">Loading...</div>
            <div class="market-card-change change-positive" id="hottestSectorChange">
              <span id="hottestSectorPercent">0.00%</span>
              <svg class="change-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="19" x2="12" y2="5"></line>
                <polyline points="5 12 12 5 19 12"></polyline>
              </svg>
            </div>
          </div>
        </div>
        
        <div class="market-card">
          <div class="market-card-header">
            <div class="market-card-label">Worst Sector</div>
          </div>
          <div class="market-card-content">
            <div class="market-card-value" id="worstSector">Loading...</div>
            <div class="market-card-change change-negative" id="worstSectorChange">
              <span id="worstSectorPercent">0.00%</span>
              <svg class="change-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <polyline points="19 12 12 19 5 12"></polyline>
              </svg>
            </div>
          </div>
        </div>
        
        <div class="market-card">
          <div class="market-card-header">
            <div class="market-card-label">Top Stock</div>
          </div>
          <div class="market-card-content">
            <div class="market-card-value" id="topStock">Loading...</div>
            <div class="market-card-change change-positive" id="topStockChange">
              <span id="topStockPercent">0.00%</span>
              <svg class="change-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="19" x2="12" y2="5"></line>
                <polyline points="5 12 12 5 19 12"></polyline>
              </svg>
            </div>
          </div>
        </div>
        
        <div class="market-card">
          <div class="market-card-header">
            <div class="market-card-label">Worst Stock</div>
          </div>
          <div class="market-card-content">
            <div class="market-card-value" id="worstStock">Loading...</div>
            <div class="market-card-change change-negative" id="worstStockChange">
              <span id="worstStockPercent">0.00%</span>
              <svg class="change-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <polyline points="19 12 12 19 5 12"></polyline>
              </svg>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Main Dashboard Grid -->
      <div class="dashboard-grid">
        <!-- Top Market Cap List -->
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Top Market Cap</h2>
          </div>
          <div class="card-content">
            <ul class="stocks-list" id="stocksList">
              <!-- Stock items will be populated dynamically -->
              <li class="stock-item">
                <div class="stock-info">
                  <div class="stock-symbol">Loading...</div>
                  <div class="stock-name">Please wait...</div>
                </div>
                <div class="stock-actions">
                  <div class="stock-price">
                    <div class="stock-current">-</div>
                    <div class="stock-change">-</div>
                  </div>
                  <button class="buy-button" data-symbol="" style="visibility: hidden;">
                    <svg class="buy-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="9" cy="21" r="1"></circle>
                      <circle cx="20" cy="21" r="1"></circle>
                      <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    Buy
                  </button>
                </div>
              </li>
            </ul>
          </div>
        </div>
        
        <!-- Stock Chart -->
        <div class="card">
          <div class="card-header chart-header">
            <div class="chart-info">
              <div class="chart-stock-header">
                <h2 class="chart-symbol" id="chartSymbol">AAPL</h2>
                <span class="chart-price" id="chartPrice">$175.24</span>
                <span class="chart-badge positive" id="chartBadge">+2.34%</span>
              </div>
              <div class="chart-company" id="chartCompany">Apple Inc.</div>
            </div>
            <div class="chart-controls">
              <button class="chart-period-button" data-period="1D">1D</button>
              <button class="chart-period-button active" data-period="5D">5D</button>
              <button class="chart-period-button" data-period="1M">1M</button>
              <button class="chart-period-button" data-period="3M">3M</button>
              <button class="chart-period-button" data-period="1Y">1Y</button>
              <button class="chart-period-button" data-period="ALL">ALL</button>
            </div>
          </div>
          <div class="chart-container" id="chartContainer">
            <div class="interactive-chart" id="interactiveChart"></div>
            <div class="chart-tooltip" id="chartTooltip">
              <div class="tooltip-date">Jun 15, 2023</div>
              <div class="tooltip-price">$175.24</div>
              <div class="tooltip-change change-positive">
                +$4.02 (+2.34%)
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="5 15 12 8 19 15"></polyline>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Gainers Table -->
      <div class="section-heading">
        <div class="section-left">
          Biggest Gainers
          <span class="section-badge positive">+</span>
        </div>
      </div>
      <div class="card">
        <div class="card-content">
          <table>
            <thead>
              <tr>
                <th>Symbol</th>
                <th>Name</th>
                <th>Price</th>
                <th>Change</th>
                <th class="hide-mobile">Volume</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="gainersTable">
              <!-- Gainers will be populated dynamically -->
              <tr>
                <td colspan="6" style="text-align: center;">Loading data...</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
      <!-- Losers Table -->
      <div class="section-heading" style="margin-top: 2rem;">
        <div class="section-left">
          Biggest Losers
          <span class="section-badge negative">-</span>
        </div>
      </div>
      <div class="card">
        <div class="card-content">
          <table>
            <thead>
              <tr>
                <th>Symbol</th>
                <th>Name</th>
                <th>Price</th>
                <th>Change</th>
                <th class="hide-mobile">Volume</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="losersTable">
              <!-- Losers will be populated dynamically -->
              <tr>
                <td colspan="6" style="text-align: center;">Loading data...</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>
    
    <!-- Footer -->
    <footer>
      <div class="footer-container">
        <p class="footer-copyright">© 2025 TradeSense. All rights reserved.</p>
        <div class="footer-links">
          <a href="#" class="footer-link">Terms of Service</a>
          <span class="footer-separator">•</span>
          <a href="#" class="footer-link">Privacy Policy</a>
        </div>
      </div>
    </footer>
  </div>
  
  <!-- Buy Modal -->
  <div class="modal" id="buyModal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="buyModalTitle">Buy Stock</h3>
        <button class="modal-close" id="closeModal">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label" for="buySymbol">Symbol</label>
          <input type="text" class="form-control" id="buySymbol" disabled>
        </div>
        <div class="form-group">
          <label class="form-label" for="buyCompany">Company</label>
          <input type="text" class="form-control" id="buyCompany" disabled>
        </div>
        <div class="form-group">
          <label class="form-label" for="buyPrice">Current Price</label>
          <input type="text" class="form-control" id="buyPrice" disabled>
        </div>
        <div class="form-group">
          <label class="form-label" for="buyQuantity">Quantity</label>
          <input type="number" class="form-control" id="buyQuantity" min="1" value="1">
        </div>
        <div class="form-group">
          <label class="form-label" for="buyTotal">Total Cost</label>
          <input type="text" class="form-control" id="buyTotal" disabled>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" id="cancelBuy">Cancel</button>
        <button class="btn btn-primary" id="confirmBuy">Confirm Purchase</button>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/d3@7"></script>
  <script>
    // Finnhub API key
    const apiKey = 'cvlabs9r01qj3umc5o0gcvlabs9r01qj3umc5o10';
    
    // List of stocks to track
    const stockSymbols = ['AAPL', 'MSFT', 'AMZN', 'GOOGL', 'META', 'TSLA', 'NVDA', 'JPM', 'V', 'WMT', 'JNJ', 'PG', 'MA', 'UNH', 'HD'];
    
    // Company name mappings
    const companyNames = {
      'AAPL': 'Apple Inc.',
      'MSFT': 'Microsoft Corporation',
      'AMZN': 'Amazon.com Inc.',
      'GOOGL': 'Alphabet Inc.',
      'META': 'Meta Platforms Inc.',
      'TSLA': 'Tesla Inc.',
      'NVDA': 'NVIDIA Corporation',
      'JPM': 'JPMorgan Chase & Co.',
      'V': 'Visa Inc.',
      'WMT': 'Walmart Inc.',
      'JNJ': 'Johnson & Johnson',
      'PG': 'Procter & Gamble Co.',
      'MA': 'Mastercard Inc.',
      'UNH': 'UnitedHealth Group Inc.',
      'HD': 'Home Depot Inc.'
    };
    
    // Store stock data globally
    let stocksData = [];
    let selectedStock = null;
    
    // DOM elements
    const apiErrorElement = document.getElementById('apiError');
    const apiErrorMessageElement = document.getElementById('apiErrorMessage');
    const stocksListElement = document.getElementById('stocksList');
    const gainersTableElement = document.getElementById('gainersTable');
    const losersTableElement = document.getElementById('losersTable');
    const chartContainerElement = document.getElementById('chartContainer');
    const searchInputElement = document.getElementById('stockSearch');
    
    // Buy modal elements
    const buyModalElement = document.getElementById('buyModal');
    const buyModalTitleElement = document.getElementById('buyModalTitle');
    const buySymbolElement = document.getElementById('buySymbol');
    const buyCompanyElement = document.getElementById('buyCompany');
    const buyPriceElement = document.getElementById('buyPrice');
    const buyQuantityElement = document.getElementById('buyQuantity');
    const buyTotalElement = document.getElementById('buyTotal');
    const closeModalButton = document.getElementById('closeModal');
    const cancelBuyButton = document.getElementById('cancelBuy');
    const confirmBuyButton = document.getElementById('confirmBuy');
    
    // Initialize the dashboard
    async function initDashboard() {
      try {
        // Fetch market data
        await fetchMarketOverview();
        
        // Fetch stock data
        await fetchStocksData();
        
        // If no stock is selected, select the first one
        if (!selectedStock && stocksData.length > 0) {
          selectStock(stocksData[0]);
        }
      } catch (error) {
        console.error('Dashboard initialization error:', error);
        showApiError('Failed to initialize dashboard. ' + error.message);
      }
    }
    
    // Fetch market overview data
    async function fetchMarketOverview() {
      try {
        // In a real app, this would use actual API data
        // For now, we'll generate mock data
        
        // Mock sector data
        const mockSectors = [
          { name: 'Technology', performance: 0.0184 },
          { name: 'Healthcare', performance: 0.0132 },
          { name: 'Consumer Cyclical', performance: 0.0087 },
          { name: 'Financial Services', performance: 0.0023 },
          { name: 'Communication Services', performance: -0.0045 },
          { name: 'Energy', performance: -0.0198 }
        ];
        
        // Find best and worst sectors
        const bestSector = mockSectors.reduce((prev, current) => 
          (prev.performance > current.performance) ? prev : current
        );
        
        const worstSector = mockSectors.reduce((prev, current) => 
          (prev.performance < current.performance) ? prev : current
        );
        
        // Update UI
        document.getElementById('hottestSector').textContent = bestSector.name;
        document.getElementById('hottestSectorPercent').textContent = (bestSector.performance * 100).toFixed(2) + '%';
        
        document.getElementById('worstSector').textContent = worstSector.name;
        document.getElementById('worstSectorPercent').textContent = (worstSector.performance * 100).toFixed(2) + '%';
        
        // Determine market status - simple algorithm based on sector performance
        const sectorsUp = mockSectors.filter(s => s.performance > 0).length;
        const isMarketPositive = sectorsUp > mockSectors.length / 2;
        document.getElementById('marketStatus').textContent = isMarketPositive ? 'Bullish' : 'Bearish';
      } catch (error) {
        console.error('Error fetching market overview:', error);
        // Use fallback data
        document.getElementById('hottestSector').textContent = 'Technology';
        document.getElementById('hottestSectorPercent').textContent = '1.84%';
        document.getElementById('worstSector').textContent = 'Energy';
        document.getElementById('worstSectorPercent').textContent = '-1.98%';
        document.getElementById('marketStatus').textContent = Math.random() > 0.5 ? 'Bullish' : 'Bearish';
      }
    }
    
    // Fetch data for all stocks
    async function fetchStocksData() {
      try {
        // Clear existing data
        stocksData = [];
        
        // Generate random stock data
        stockSymbols.forEach(symbol => {
          const basePrice = Math.random() * 300 + 50; // Random price between 50 and 350
          const changePercent = (Math.random() * 10 - 5); // Random change between -5% and 5%
          const change = basePrice * changePercent / 100;
          
          stocksData.push({
            symbol,
            companyName: companyNames[symbol] || symbol,
            price: parseFloat(basePrice.toFixed(2)),
            change: parseFloat(change.toFixed(2)),
            changePercent: parseFloat(changePercent.toFixed(2)),
            volume: Math.floor(Math.random() * 20000000) + 5000000 // Random volume
          });
        });
        
        // Sort by market cap or price (in a real app, we'd sort by actual market cap)
        stocksData.sort((a, b) => b.price - a.price);
        
        // Populate the stocks list
        updateStocksList();
        
        // Determine top and worst performers
        if (stocksData.length > 0) {
          // Sort by percentage change
          const sortedByChange = [...stocksData].sort((a, b) => b.changePercent - a.changePercent);
          
          // Get top and bottom performers
          const topPerformer = sortedByChange[0];
          const worstPerformer = sortedByChange[sortedByChange.length - 1];
          
          // Update the UI
          document.getElementById('topStock').textContent = topPerformer.symbol;
          document.getElementById('topStockPercent').textContent = topPerformer.changePercent.toFixed(2) + '%';
          
          document.getElementById('worstStock').textContent = worstPerformer.symbol;
          document.getElementById('worstStockPercent').textContent = worstPerformer.changePercent.toFixed(2) + '%';
          
          // Determine market leader (highest priced stock as a simple proxy)
          document.getElementById('marketLeader').textContent = stocksData[0].symbol;
          
          // Update gainers and losers tables
          updateGainersLosers(sortedByChange);
        }
      } catch (error) {
        console.error('Error fetching stocks data:', error);
        showApiError('Failed to fetch stocks data: ' + error.message);
      }
    }
    
    // Update the stocks list in the UI
    function updateStocksList() {
      // Clear the list
      stocksListElement.innerHTML = '';
      
      // Add each stock
      stocksData.forEach(stock => {
        const listItem = document.createElement('li');
        listItem.className = 'stock-item';
        listItem.innerHTML = `
          <div class="stock-info">
            <div class="stock-symbol">${stock.symbol}</div>
            <div class="stock-name">${stock.companyName || stock.symbol}</div>
          </div>
          <div class="stock-actions">
            <div class="stock-price">
              <div class="stock-current">$${stock.price.toFixed(2)}</div>
              <div class="stock-change ${stock.changePercent >= 0 ? 'change-positive' : 'change-negative'}">
                ${stock.changePercent >= 0 ? '+' : ''}${stock.changePercent.toFixed(2)}%
              </div>
            </div>
            <button class="buy-button" data-symbol="${stock.symbol}">
              <svg class="buy-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
              </svg>
              Buy
            </button>
          </div>
        `;
        
        // Add click event for selecting stock
        listItem.addEventListener('click', (e) => {
          // Don't trigger if clicking the buy button
          if (e.target.closest('.buy-button')) return;
          selectStock(stock);
        });
        
        // Add click event for buy button
        const buyButton = listItem.querySelector('.buy-button');
        buyButton.addEventListener('click', () => openBuyModal(stock));
        
        // Add to the list
        stocksListElement.appendChild(listItem);
      });
    }
    
    // Update gainers and losers tables
    function updateGainersLosers(sortedStocks) {
      // Clear tables
      gainersTableElement.innerHTML = '';
      losersTableElement.innerHTML = '';
      
      // Add top 5 gainers
      const gainers = sortedStocks.filter(stock => stock.changePercent > 0).slice(0, 5);
      gainers.forEach(stock => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td class="stocks-table-symbol">${stock.symbol}</td>
          <td><div class="stocks-table-name">${stock.companyName || stock.symbol}</div></td>
          <td>$${stock.price.toFixed(2)}</td>
          <td class="change-positive">+${stock.changePercent.toFixed(2)}%</td>
          <td class="hide-mobile">${stock.volume.toLocaleString()}</td>
          <td>
            <button class="buy-button" data-symbol="${stock.symbol}">
              <svg class="buy-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
              </svg>
              Buy
            </button>
          </td>
        `;
        
        // Add click event for buy button
        const buyButton = row.querySelector('.buy-button');
        buyButton.addEventListener('click', () => openBuyModal(stock));
        
        gainersTableElement.appendChild(row);
      });
      
      // Add "no gainers" message if needed
      if (gainers.length === 0) {
        const row = document.createElement('tr');
        row.innerHTML = '<td colspan="6" style="text-align: center;">No gainers found today</td>';
        gainersTableElement.appendChild(row);
      }
      
      // Add top 5 losers
      const losers = [...sortedStocks].filter(stock => stock.changePercent < 0).slice(-5).reverse();
      losers.forEach(stock => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td class="stocks-table-symbol">${stock.symbol}</td>
          <td><div class="stocks-table-name">${stock.companyName || stock.symbol}</div></td>
          <td>$${stock.price.toFixed(2)}</td>
          <td class="change-negative">${stock.changePercent.toFixed(2)}%</td>
          <td class="hide-mobile">${stock.volume.toLocaleString()}</td>
          <td>
            <button class="buy-button" data-symbol="${stock.symbol}">
              <svg class="buy-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
              </svg>
              Buy
            </button>
          </td>
        `;
        
        // Add click event for buy button
        const buyButton = row.querySelector('.buy-button');
        buyButton.addEventListener('click', () => openBuyModal(stock));
        
        losersTableElement.appendChild(row);
      });
      
      // Add "no losers" message if needed
      if (losers.length === 0) {
        const row = document.createElement('tr');
        row.innerHTML = '<td colspan="6" style="text-align: center;">No losers found today</td>';
        losersTableElement.appendChild(row);
      }
    }
    
    // Select a stock and update the chart
    function selectStock(stock) {
      selectedStock = stock;
      
      // Update the UI to show the selected stock
      document.querySelectorAll('.stock-item').forEach(item => {
        const symbol = item.querySelector('.stock-symbol').textContent;
        if (symbol === stock.symbol) {
          item.classList.add('selected');
        } else {
          item.classList.remove('selected');
        }
      });
      
      // Update chart header
      document.getElementById('chartSymbol').textContent = stock.symbol;
      document.getElementById('chartPrice').textContent = `$${stock.price.toFixed(2)}`;
      document.getElementById('chartCompany').textContent = stock.companyName || stock.symbol;
      
      const chartBadge = document.getElementById('chartBadge');
      chartBadge.textContent = `${stock.changePercent >= 0 ? '+' : ''}${stock.changePercent.toFixed(2)}%`;
      chartBadge.className = `chart-badge ${stock.changePercent >= 0 ? 'positive' : 'negative'}`;
      
      // Load the chart
      loadChart(stock.symbol, stock.changePercent >= 0);
    }
    
    // Load the historical chart data
    function loadChart(symbol, isPositive) {
      // Show loading spinner
      chartContainerElement.innerHTML = '<div class="loading-spinner"></div>';
      
      // Generate dates for the past 30 days
      const dates = [];
      const prices = [];
      const basePrice = selectedStock.price;
      const volatility = 2; // Higher value = more volatile
      
      // Generate historical prices with some randomness but trending in the direction of isPositive
      for (let i = 30; i >= 0; i--) {
        const date = new Date();
        date.setDate(date.getDate() - i);
        dates.push(date.toISOString().split('T')[0]);
        
        // Create a price path that trends up or down based on isPositive
        // but with some daily volatility
        const dayChange = (Math.random() - (isPositive ? 0.35 : 0.65)) * volatility;
        const trend = isPositive ? i * 0.15 : -i * 0.15; // Overall trend direction
        
        let newPrice;
        if (i === 30) {
          // Starting price (30 days ago)
          newPrice = basePrice - (isPositive ? basePrice * 0.1 : -basePrice * 0.1);
        } else {
          // Each day's price based on previous day plus some randomness and the trend
          newPrice = prices[prices.length - 1] + dayChange + trend/30;
        }
        
        // Ensure price doesn't go negative
        newPrice = Math.max(newPrice, basePrice * 0.5);
        prices.push(parseFloat(newPrice.toFixed(2)));
      }
      
      // Combine dates and prices into data points
      const chartData = dates.map((date, i) => ({
        date,
        price: prices[i]
      }));
      
      // Render the enhanced interactive chart
      setTimeout(() => {
        renderEnhancedChart(chartData, isPositive);
      }, 800);
    }
    
    function renderEnhancedChart(data, isPositive) {
      const chartContainer = document.getElementById('chartContainer');
      chartContainer.innerHTML = '<div class="interactive-chart" id="interactiveChart"></div><div class="chart-tooltip" id="chartTooltip"></div>';
      
      const chartElement = document.getElementById('interactiveChart');
      const tooltipElement = document.getElementById('chartTooltip');
      
      // Get dimensions
      const containerWidth = chartContainer.clientWidth;
      const containerHeight = chartContainer.clientHeight;
      
      // Create SVG
      const svg = d3.select(chartElement)
        .append('svg')
        .attr('width', '100%')
        .attr('height', '100%')
        .attr('viewBox', `0 0 ${containerWidth} ${containerHeight}`)
        .attr('preserveAspectRatio', 'xMidYMid meet');
      
      // Calculate margins
      const margin = { top: 20, right: 30, bottom: 30, left: 50 };
      const width = containerWidth - margin.left - margin.right;
      const height = containerHeight - margin.top - margin.bottom;
      
      // Use only the last 14 data points for a 2-week view
      const chartData = data.slice(-14);
      
      // Calculate min and max prices for y scale with a little padding
      const prices = chartData.map(d => d.price);
      const minPrice = Math.min(...prices) * 0.995;
      const maxPrice = Math.max(...prices) * 1.005;
      
      // Create scales
      const x = d3.scaleTime()
        .domain(d3.extent(chartData, d => new Date(d.date)))
        .range([0, width]);
      
      const y = d3.scaleLinear()
        .domain([minPrice, maxPrice])
        .range([height, 0]);
      
      // Create the chart group with margin
      const chart = svg.append('g')
        .attr('transform', `translate(${margin.left},${margin.top})`);
      
      // Add gradient for area fill
      const gradient = svg.append('defs')
        .append('linearGradient')
        .attr('id', 'area-gradient')
        .attr('x1', '0%')
        .attr('y1', '0%')
        .attr('x2', '0%')
        .attr('y2', '100%');
      
      gradient.append('stop')
        .attr('offset', '0%')
        .attr('stop-color', isPositive ? '#10b981' : '#ef4444')
        .attr('stop-opacity', 0.5);
      
      gradient.append('stop')
        .attr('offset', '100%')
        .attr('stop-color', isPositive ? '#10b981' : '#ef4444')
        .attr('stop-opacity', 0);
      
      // Add gridlines
      chart.append('g')
        .attr('class', 'chart-grid')
        .call(d3.axisLeft(y)
          .tickSize(-width)
          .tickFormat('')
        );
      
      // Add X axis
      chart.append('g')
        .attr('class', 'chart-axis')
        .attr('transform', `translate(0,${height})`)
        .call(d3.axisBottom(x)
          .tickFormat(d => {
            const date = new Date(d);
            return `${date.getMonth() + 1}/${date.getDate()}`;
          })
          .ticks(7)
        );
      
      // Add Y axis
      chart.append('g')
        .attr('class', 'chart-axis')
        .call(d3.axisLeft(y)
          .tickFormat(d => `$${d.toFixed(0)}`)
          .ticks(5)
        );
      
      // Create line generator
      const line = d3.line()
        .x(d => x(new Date(d.date)))
        .y(d => y(d.price))
        .curve(d3.curveMonotoneX);
      
      // Create area generator
      const area = d3.area()
        .x(d => x(new Date(d.date)))
        .y0(height)
        .y1(d => y(d.price))
        .curve(d3.curveMonotoneX);
      
      // Add the area path
      chart.append('path')
        .datum(chartData)
        .attr('class', 'chart-area')
        .attr('d', area)
        .attr('fill', 'url(#area-gradient)');
      
      // Add the line path
      chart.append('path')
        .datum(chartData)
        .attr('class', 'chart-line')
        .attr('fill', 'none')
        .attr('stroke', isPositive ? '#10b981' : '#ef4444')
        .attr('stroke-width', 2)
        .attr('d', line);
      
      // Add data points
      const dots = chart.selectAll('.data-point')
        .data(chartData)
        .enter()
        .append('circle')
        .attr('class', 'chart-dot')
        .attr('cx', d => x(new Date(d.date)))
        .attr('cy', d => y(d.price))
        .attr('r', 0) // Start with radius 0
        .attr('fill', 'white')
        .attr('stroke', isPositive ? '#10b981' : '#ef4444');
      
      // Animate dots appearance
      dots.transition()
        .duration(800)
        .attr('r', 3.5);
      
      // Interactive overlay for tooltips
      const bisect = d3.bisector(d => new Date(d.date)).left;
      
      // Add invisible overlay for mouse tracking
      const overlay = chart.append('rect')
        .attr('width', width)
        .attr('height', height)
        .attr('fill', 'none')
        .attr('pointer-events', 'all');
      
      // Create tooltip line
      const tooltipLine = chart.append('line')
        .attr('class', 'tooltip-line')
        .attr('y1', 0)
        .attr('y2', height)
        .attr('stroke', '#475569')
        .attr('stroke-width', 1)
        .attr('stroke-dasharray', '3,3')
        .style('opacity', 0);
      
      // Create active point
      const activePoint = chart.append('circle')
        .attr('class', 'active-point')
        .attr('r', 6)
        .attr('fill', isPositive ? '#10b981' : '#ef4444')
        .attr('stroke', '#fff')
        .attr('stroke-width', 2)
        .style('opacity', 0);
      
      // Handle mouse events
      overlay
        .on('mousemove', function(event) {
          const [mouseX] = d3.pointer(event);
          const x0 = x.invert(mouseX);
          const i = bisect(chartData, x0, 1);
          const d0 = chartData[i - 1];
          const d1 = chartData[i];
          
          if (!d0 || !d1) return;
          
          const d = x0 - new Date(d0.date) > new Date(d1.date) - x0 ? d1 : d0;
          
          // Position the tooltip line
          tooltipLine
            .attr('x1', x(new Date(d.date)))
            .attr('x2', x(new Date(d.date)))
            .style('opacity', 1);
          
          // Position the active point
          activePoint
            .attr('cx', x(new Date(d.date)))
            .attr('cy', y(d.price))
            .style('opacity', 1);
          
          // Calculate the previous day's price for change
          const prevIndex = chartData.indexOf(d) - 1;
          const prevPrice = prevIndex >= 0 ? chartData[prevIndex].price : d.price;
          const change = d.price - prevPrice;
          const changePercent = (change / prevPrice) * 100;
          const isPositiveChange = change >= 0;
          
          // Format date for tooltip
          const dateObj = new Date(d.date);
          const formattedDate = dateObj.toLocaleDateString('en-US', { 
            year: 'numeric', 
            month: 'short', 
            day: 'numeric' 
          });
          
          // Update tooltip content
          tooltipElement.innerHTML = `
            <div class="tooltip-date">${formattedDate}</div>
            <div class="tooltip-price">$${d.price.toFixed(2)}</div>
            <div class="tooltip-change ${isPositiveChange ? 'change-positive' : 'change-negative'}">
              ${isPositiveChange ? '+' : ''}$${Math.abs(change).toFixed(2)} (${isPositiveChange ? '+' : ''}${changePercent.toFixed(2)}%)
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="${isPositiveChange ? '5 15 12 8 19 15' : '5 9 12 16 19 9'}"></polyline>
              </svg>
            </div>
          `;
          
          // Position and show tooltip
          const tooltipWidth = tooltipElement.offsetWidth;
          const chartRect = chartContainer.getBoundingClientRect();
          const svgPoint = document.querySelector('svg').createSVGPoint();
          svgPoint.x = x(new Date(d.date)) + margin.left;
          svgPoint.y = y(d.price) + margin.top;
          
          const screenPoint = svgPoint.matrixTransform(document.querySelector('svg').getScreenCTM());
          const relativeLeft = screenPoint.x - chartRect.left;
          
          tooltipElement.style.left = `${relativeLeft}px`;
          tooltipElement.style.top = `${svgPoint.y - 20}px`;
          tooltipElement.classList.add('active');
        })
        .on('mouseleave', function() {
          tooltipLine.style('opacity', 0);
          activePoint.style('opacity', 0);
          tooltipElement.classList.remove('active');
        });
      
      // Add period button event listeners
      document.querySelectorAll('.chart-period-button').forEach(button => {
        button.addEventListener('click', function() {
          document.querySelectorAll('.chart-period-button').forEach(btn => {
            btn.classList.remove('active');
          });
          this.classList.add('active');
          
          // In a real app, this would load different time period data
          // For this demo, we'll just reload the chart with the same data
          const period = this.getAttribute('data-period');
          document.querySelector('.chart-period').textContent = `${period} Trend`;
          
          renderEnhancedChart(data, isPositive);
        });
      });
    }
    
    
    // Show API error message
    function showApiError(message) {
      apiErrorMessageElement.textContent = message;
      apiErrorElement.style.display = 'block';
    }
    
    // Buy modal functions
    function openBuyModal(stock) {
      // Update modal content
      buyModalTitleElement.textContent = `Buy ${stock.symbol} Stock`;
      buySymbolElement.value = stock.symbol;
      buyCompanyElement.value = stock.companyName;
      buyPriceElement.value = `$${stock.price.toFixed(2)}`;
      buyQuantityElement.value = '1';
      updateBuyTotal();
      
      // Show modal
      buyModalElement.classList.add('active');
      
      // Store selected stock
      selectedStock = stock;
    }
    
    function closeBuyModal() {
      buyModalElement.classList.remove('active');
    }
    
    function updateBuyTotal() {
      const quantity = parseInt(buyQuantityElement.value) || 1;
      buyTotalElement.value = `$${(selectedStock.price * quantity).toFixed(2)}`;
    }
    
    function buyStock() {
      const quantity = parseInt(buyQuantityElement.value) || 1;
      const total = selectedStock.price * quantity;
      
      // In a real app, this would connect to a backend to process the transaction
      // For now, we'll just show an alert
      alert(`Purchase successful! You bought ${quantity} shares of ${selectedStock.symbol} for $${total.toFixed(2)}.`);
      
      closeBuyModal();
    }
    
    // Event listeners
    document.addEventListener('DOMContentLoaded', initDashboard);
    
    // Buy modal event listeners
    closeModalButton.addEventListener('click', closeBuyModal);
    cancelBuyButton.addEventListener('click', closeBuyModal);
    confirmBuyButton.addEventListener('click', buyStock);
    buyQuantityElement.addEventListener('input', updateBuyTotal);
    
    // Search functionality
    searchInputElement.addEventListener('input', function() {
      const searchQuery = this.value.toUpperCase();
      if (searchQuery.length > 0) {
        // Filter stocks based on search query
        document.querySelectorAll('.stock-item').forEach(item => {
          const symbol = item.querySelector('.stock-symbol').textContent;
          const name = item.querySelector('.stock-name').textContent;
          
          if (symbol.toUpperCase().includes(searchQuery) || name.toUpperCase().includes(searchQuery)) {
            item.style.display = '';
          } else {
            item.style.display = 'none';
          }
        });
      } else {
        // Show all stocks
        document.querySelectorAll('.stock-item').forEach(item => {
          item.style.display = '';
        });
      }
    });
    
    // Logout button handler
    document.querySelector('.logout-button').addEventListener('click', function() {
      window.location.href = 'index.html';
    });
    
    document.addEventListener('DOMContentLoaded', initDashboard);
  </script>
</body>
</html>
