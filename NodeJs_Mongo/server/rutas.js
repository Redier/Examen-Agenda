const Router = require('express').Router();
const Events  = require('./eventModel.js');
const Users  = require('./userModel.js');

// Funcion para el login de la pagina
Router.post('/login', function (req, res){

  let usuario = req.body.user
  let password = req.body.pass

  Users.findOne({user: this.usuario}).exec(function(err, doc){
      if (err) {
          res.status(500)
          res.json(err)
      }
      if(doc.password == password){
        res.send("Validado")
      }
  })

})
// Obtener los eventos del usuario
Router.get('/all', function (req, res){
    Events.find({}).exec(function(err, docs) {
        if (err) {
            res.status(500)
            res.json(err)
        }
        res.json(docs)
    })
  })

Router.post('/new', function (req, res){
  let data = new Events({
        id: Math.floor(Math.random() * 50),
        title: req.body.title,
        start: req.body.start,
        end: req.body.end
    })
  data.save(function (err) {
    if (err){
      res.status(500)
      res.json(err)
    }
    res.send("Registro almacenado")
    })
  })

  Router.post('/delete/:id', function(req, res) {
    let uid = req.params.id
    Events.remove({id: uid}, function(error) {
        if(error) {
            res.status(500)
            res.json(error)
        }
        res.send("Registro eliminado")
    })
  })
  Router.post('/update', function(req, res) {

    Events.findOne({id: req.body.id}).exec(function(err, doc){
        if (err) {
            res.status(500)
            res.json(err)
        }
        console.log(doc);

        Events.update({id: req.body.id},{start: req.body.start},(error,resultado)=>{
          if(error)res(error)
          console.log(resultado);
          res.send("Evento actualizado")
                })
    })


    //let data = new Events({
        //  id: req.body.id,
        //  title: req.body.title,
      //    start: req.body.start,
      //    end: req.body.end
    //    })
  //  let nuevoEvento = req.body
  //  Events.remove({id: req.body.id},(err)=>{
  //    if(err)res.json(err)
  //  })
  //  data.save((err)=>{
      //if (err){
        //res.status(500)
      //  res.json(err)
    //  }
  //    res.send("Registro Actualizado")
//    })


  })

module.exports= Router
