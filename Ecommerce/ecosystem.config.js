module.exports = {
  apps : [{
    name   : "ecommerce-app",
    script : "php",
    args   : "-S 0.0.0.0:80 -t pages/",
    cwd    : "/var/www/html/Ecommerce",
    interpreter: "none",
    env: {
      DB_USER: "ecommerce_user",
      DB_PASS: "secure_password",
      DB_HOST: "localhost",
      DB_NAME: "Ecommerce"
    }
  }]
}
