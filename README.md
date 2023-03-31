Runners Euro Comp

Welcome to the Runners Euro Comp application!

Description

Runners Crisps is a UK-based food company that sells crisps and similar snacks to a global client base. They have contracted me to design a solution and provide a proof of concept for their forthcoming promotional activity, to launch a new football-themed crisp. The launch will coincide with the next European Cup final, with the company printing special promotional bags containing the URL to a free prize draw.

The proof of concept solution I have developed is a cloud-based web application that provides a web form for users to enter a 10-digit hexadecimal code from the promotional bag, along with their personal information. On submission of the form, the code is validated and the user data is stored in the data tier. A voucher code is then returned to the presentation tier to be displayed to the user. The voucher code provides 10% off the next purchase, or for 1 in 100 users, a voucher for a free football.

As the European Cup final is a global event, I have ensured that the website provides the lowest latency possible even at peak times. I have used a scalable cloud solution that can handle high traffic volume with low latency and no downtime during the European Cup final. The solution uses load balancers and auto-scaling groups to ensure that the service can scale up or down as needed to handle the volume of traffic.

To ensure that the 10-digit code from the bag is not used more than once, I have implemented a validation process in the business tier, which communicates with the presentation tier via a PHP page.

I have also considered how the company will gain access to the data stored in the data tier for post-processing and how the application code will be deployed and managed. I have created a single command method of deployment for both platform and application code, which simplifies the deployment process for the company.

Overall, I are confident that our proof of concept solution will meet the needs of Runners Crisps for their promotional activity, and look forward to their feedback on the solution I developed.

Installation

To install the application, follow these steps:

1. Clone the repository to your local machine
git clone https://github.com/username/repository-name.git

2. Install docker compose via Ubuntu 
sudo apt install docker-compose


3. Build docker images for services defined in the Docker Compose file 
sudo docker-compose build

4. Launch services defined in the Docker Compose file
sudo docker-compose up -d

To use the application, simply fill out the form with your name, email, address, 10 digit hex code, and the name of your favorite player. Then click the "Submit" button to enter the competition.

Testing

For testing purposes we have provided three scripts and injected them into the database, each will have different outcomes. 

1. Unredeemed Voucher Code (10%): 4e6d8f2a1b
2. Redeemed Voucher Code (10%): a8f6b9c7d0
3. Unredeemed Voucher Code (FREEBALL): 4e6d8f2a1b

Credits

This application was created by Luka Ginley as a project for assignment (6130COMP).