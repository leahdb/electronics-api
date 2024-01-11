let mix = require("laravel-mix");
const { sass } = require("laravel-mix");

mix.sass("resources/scss/dashboard.scss", "public/css");
