# Electricity Consumption Calculator (PHP & Bootstrap 4)

A simple, modern, and clean web application built with vanilla PHP and Bootstrap 4 to calculate electricity power, energy usage and costs based on current rates.

## Features
- **Dynamic Calculations:** Calculate Power (kW) and Rate (RM) instantly based on user input.
- **Usage Projection:** Displays a detailed 24-hour breakdown of energy consumption (kWh) and total cost (RM).
- **Modern UI:** Built with Bootstrap 4 and custom CSS featuring a dark-themed gradient header and soft shadows.
- **Responsive Design:** Works on desktops, tablets, and mobile devices.

## Formulas Used
The application uses the following logic based on electrical standards:
- **Power (kW):** `(Voltage * Current) / 1000`
- **Energy (kWh):** `Power (kW) * Time (Hours)`
- **Total Cost (RM):** `Energy (kWh) * (Current Rate / 100)`

## Requirements
- PHP 7.4 or higher
- A local server (e.g., XAMPP, WAMP, or MAMP)
- Web Browser (Chrome, Firefox, etc.)

## Installation
1. Clone this repository or download the files.
2. Place the folder into your server's root directory (e.g., `C:/xampp/htdocs/`).
3. Start your Apache server.
4. Open your browser and navigate to `http://localhost/folder-name/index.php`.

## 📸 Preview
![Screenshot of the Calculator](https://via.placeholder.com/800x400?text=Electricity+Calculator+Preview)