## Back-end-ETZ API

[![My Skills](https://skillicons.dev/icons?i=php)](https://skillicons.dev)

This repository contains the backend API for ETZ (Example Treatment Zone). The API serves various functions related to user authentication, patient data retrieval, and settings management.

### Function Descriptions:

1. **login:**
   - Endpoint: `/login`
   - Description: Authenticates a user based on email and password.
   - Method: POST
   - Parameters:
     - `email` (string): User's email address.
     - `password` (string): User's password.
   - Returns:
     - `token` (JSON): Authentication for the user session.

2. **history:**
   - Endpoint: `/history`
   - Description: Retrieves the history of a patient's interactions, including details from related entities.
   - Method: GET
   - Parameters:
     - `patient_id` (string): ID of the patient whose history is to be retrieved.
   - Returns:
     - `history_data` (JSON): History data including interaction details.

3. **getPatientSetting:**
   - Endpoint: `/patient/settings`
   - Description: Retrieves settings for a patient.
   - Method: GET
   - Parameters:
     - `patient_id` (string): ID of the patient whose settings are to be retrieved.
   - Returns:
     - `settings_data` (JSON): Patient settings data.

4. **updateSetting:**
   - Endpoint: `/patient/settings`
   - Description: Updates settings for a patient.
   - Method: POST
   - Parameters:
     - `patient_id` (string): ID of the patient whose settings are to be updated.
     - `new_settings` (JSON): New settings data to be updated.
   - Returns:
     - `status` (JSON): Success or failure message.

5. **getVerwantSettings:**
   - Endpoint: `/verwant/settings`
   - Description: Retrieves settings for a relative.
   - Method: GET
   - Parameters:
     - `verwant_id` (string): ID of the relative whose settings are to be retrieved.
   - Returns:
     - `settings_data` (JSON): Relative settings data.

6. **updateVerwantSettings:**
   - Endpoint: `/verwant/settings`
   - Description: Updates settings for a relative.
   - Method: POST
   - Parameters:
     - `verwant_id` (string): ID of the relative whose settings are to be updated.
     - `new_settings` (JSON): New settings data to be updated.
   - Returns:
     - `status` (JSON): Success or failure message.

### Setup Instructions:
1. Clone the repository.
2. Launch Xampp or other localhost programms.
3. Select the cloned repository.
4. Go to your localhost URL.
5. Enter your crendentials in URL.

### Usage:
- Make API requests to the respective endpoints with required parameters.
- Ensure proper authentication using the generated token for protected endpoints.

### Contributors:
- MUX-ON-WINDOWS

### License:
This project is licensed under the [License Name] License - see the [LICENSE.md](LICENSE.md) file for details.
