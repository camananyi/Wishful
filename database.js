const {
    createPool
} = require("mysql");

const pool = createPool({
    host: "sql3.freesqldatabase.com",
    user: "sql3766762",
    password: "WYuuwhz7xT",
    database: "sql3766762",
    port: 3306,
    connectionLimit: 10
})

pool.query(`select * from Profile`, function(err, result, fields) {
    if (err) {
        return console.log(err);
    }
    return console.log(result);
})