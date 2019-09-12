const mongoose = require('mongoose')
const Schema = mongoose.Schema

	let EventSchema = new Schema({
		id: { type: Number, required: true, unique: true},
		title:{ type: String, require: true },
		start:{ type: Date },
		end:{ type: Date}
	})

	let EventModel = mongoose.model('Event', EventSchema)
	module.exports = EventModel
