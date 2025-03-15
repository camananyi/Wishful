const {
    createPool
} = require("mysql");

const pool = createPool({
    host: "phpmyadmin.co",
    user: "main",
    password: "WYuuwhz7xT",
    database: "sql3766762",
    connectionLimit: 10
})

pool.query(`select * from Profile`, function(err, result, fields) {
    if (err) {
        return console.log(err);
    }
    return console.log(result);
})