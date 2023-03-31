use RunnersDatabase;

// Drops the collections if they already exist to start with a clean slate
db.codes.drop();
db.users.drop();

// Function to generate a random 10 digit hexadecimal code
function generate10DigitHexCode() {
    // An array of hex values to be used to create the code
    let hexRef = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'];
    // An array to hold the generated code
    let result = [];

    // Generate 10 random hex values to create the code
    for (let n = 0; n < 10; n++) {
        result.push(hexRef[Math.floor(Math.random() * 16)]);
    }
    // Join the hex values to create the 10 digit hex code
    return result.join('');
}

// An array to hold the generated codes and coupons
const codes = [];
// A set to ensure the generated codes are unique
const ensureRandomCodes = new Set();
// A counter to keep track of the number of footballs available to give as a prize
let footballs = 10;

// Generate 100 unique random codes and coupons
while (codes.length < 100) {
    // Generate a random 10 digit hex code
    const code = generate10DigitHexCode();
    // Ensure the generated code is unique and hasn't already been added to the list
    if (!ensureRandomCodes.has(code)) {
        // Add the generated code to the list of unique codes
        ensureRandomCodes.add(code);
        // Set the default coupon as "10OFF"
        let coupon = "10OFF";
        // If there are still footballs available and the randomly generated number is 0 (1 in 10 chance)
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

// Find a code with value '4e6d8f2a1b' for testing purposes 
db.codes.findOne({ code: '4e6d8f2a1b' });

// For testing 
codes.push({'_id':90, 'code': '4e6d8f2a1b', 'coupon': 'FREEBALL', 'redeemed': false})
codes.push({'_id':89, 'code': 'c59b0e7d2f', 'coupon': '10OFF', 'redeemed': false})
codes.push({'_id':88, 'code': 'a8f6b9c7d0', 'coupon': '10OFF', 'redeemed': true})

// Insert a user with an empty document into the database
db.users.insertOne({});

