const webpack = require("webpack");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const devMode = process.env.NODE_ENV !== 'production';
const path = require("path");
const resourcePath = "./../Resources/";

module.exports = {
	entry: {
		app: [
			"./Styling/Scripts/app.js",
			"./Styling/SCSS/app.scss"
		]
	},
	output: {
		path: path.resolve(__dirname, resourcePath),
		filename: "js/[name].bundle.js"
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: "css/[name].bundle.css"
		})
	],
	module: {
		rules: [
			{
				test: /\.ts?$/,
				use: 'ts-loader',
				exclude: /node_modules/
			},
			{
				test: /.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
				exclude: /images/,
				use: [{
					loader: 'file-loader',
					options: {
						name: '[name].[ext]',
						outputPath: 'Fonts/',
						publicPath: '../Fonts/' // use relative urls
					}
				}]
			},
			{
				test: /.(gif|jpeg|jpg)$/,
				use: [{
					loader: 'file-loader',
					options: {
						name: '[name].[ext]',
						outputPath: 'Images/Theme/',
						publicPath: '../Images/Theme/' // use relative urls
					}
				}]
			},
			{
				test: /.(svg)$/,
				exclude: /node_modules/,
				use: [{
					loader: 'file-loader',
					options: {
						name: 'Icons/[name].[ext]',
						outputPath: 'Images/',
						publicPath: '../Images/' // use relative urls
					}
				}]
			},
			{
				test: /\.scss$/,
				use: [
					MiniCssExtractPlugin.loader,
					{
						loader: "css-loader",
						options: {
							url: true,
							sourceMap: true
						}
					},
					{
						loader: "postcss-loader",
						options: {
							plugins: function() {
								return [
									require("precss"),
									require("autoprefixer"),
									require("cssnano")
								]
							},
							sourceMap: true
						}
					},
					{
						loader: "sass-loader",
						options: {
							sourceMap: true
						}
					}
				]
			},
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: "babel-loader",
					options: {
						presets: ["@babel/env", "@babel/react"],
						plugins: [
							["@babel/plugin-proposal-decorators", { legacy: true }],
							["@babel/plugin-proposal-class-properties", { loose: true }],
						]
					}
				}
			}
		]
	},
	resolve: {
		extensions: ['.ts', '.js' ]
	},
	devtool: "source-map",
	mode: devMode ? "development" : "production",
};