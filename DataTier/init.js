// Import the RunnersDatabase module
use RunnersDatabase;

// Drop the collections if they already exist to start with a clean slate
db.codes.drop();
db.users.drop();

// An array to hold the generated codes and coupons
const codes = [];

// Generate 100 unique random codes and coupons
const ensureRandomCodes = new Set();
let footballs = 10;

while (codes.length < 100) {
    // Generate a random 10 digit hex code
    const code = generate10DigitHexCode();
    
    // Ensure the generated code is unique and hasn't already been added to the list
    if (!ensureRandomCodes.has(code)) {
        ensureRandomCodes.add(code);
        
        // Set the default coupon as "10OFF"
        let coupon = "10OFF";
        
        // If there are still footballs available and the randomly generated number is 0 (1 in 100 chance)
        // then set the coupon to "FREEBALL" and decrement the available number of footballs
        if (footballs > 0 && Math.floor(Math.random() * 100) == 0) {
            coupon = "FREEBALL";
            footballs--;
        }
        
        // Add the code and coupon to the list of codes
        codes.push({ code: code, coupon: coupon, redeemed: false });
    }
}

// Insert the generated codes into the database
db.codes.insertMany(codes);

// Find a code with values for testing purposes
db.codes.findOne({ code: '4e6d8f2a1b' });
db.codes.findOne({ code: 'c59b0e7d2f' });
db.codes.findOne({ code: 'a8f6b9c7d0' });

// For testing
codes.push({'_id':90, 'code': '4e6d8f2a1b', 'coupon': 'FREEBALL', 'redeemed': false})
codes.push({'_id':89, 'code': 'c59b0e7d2f', 'coupon': '10OFF', 'redeemed': false})
codes.push({'_id':88, 'code': 'a8f6b9c7d0', 'coupon': '10OFF', 'redeemed': true})

// Insert a user with an empty document into the database
db.users.insertOne({});

// Function to generate a random 10 digit hexadecimal code
function generate10DigitHexCode() {
    // An array of hex values to be used to create the code
    const hexRef = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'];
    
    // An array to hold the generated code
    const result = [];

    // Generate 10 random hex values to create the code
    for (let n = 0; n < 10; n++) {
        result.push(hexRef[Math.floor(Math.random() * 16)]);
    }
    
    // Join the hex values to create the 10 digit hex code
    return result.join('');
}
