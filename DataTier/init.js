use runners_crisps;

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
const ensureRandomCodes = new Set();
let footballs = 10;

// Generate the vouchers
db.codes.insertMany(codes);
db.codes.findOne({ 'code': '1234567890' })
db.users.insertOne({})