const mongoose = require('mongoose')

const Schema = mongoose.Schema

	let UserSchema = new Schema({
		id:{ type: Number, require: true, unique:true },
		email:{ type: String, require: true },
		password:{ type: String, require: true  }
	})

	let UserModel = mongoose.model('User', UserSchema)
	module.exports = UserModel
