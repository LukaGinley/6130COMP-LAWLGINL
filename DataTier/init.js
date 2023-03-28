use RunnersDatabase;

// Drop collections if already exists
db.codes.drop();
db.users.drop();

// Function to generate random 10 digit hex code
function generate10DigitHexCode() {
    let result = [];
    let hexRef = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'];

    for (let n = 0; n < 10; n++) {
        result.push(hexRef[Math.floor(Math.random() * 16)]);
    }
    return result.join('');
}

const codes = [];

// Generate unique random codes
while (codes.length < 10) {
    const code = generate10DigitHexCode();
    if (!ensureRandomCodes.has(code)) {
        ensureRandomCodes.add(code);
        codes.push({ code: code });
    }
}

// Insert the vouchers
db.codes.insertMany(codes);

// Find a code with value '1234567890' (if exists)
db.codes.findOne({ code: '1234567890' });

// Insert a user with empty document
db.users.insertOne({});
