using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using FinalProjectPetey.Models;

namespace FinalProjectPetey.Controllers
{

    public class SellController : Controller
    {
        PeteyEntities pe = new PeteyEntities();
        // GET: Sell

        public ActionResult Index()
        {
            ViewBag.listProduct = pe.Pets.ToList();
            //ViewBag.listProduct = pe.Products.ToList();
            //ViewBag.listProduct = pe.Trainers.ToList();
            return View();
        }

        public ActionResult Pet()
        {
            ViewBag.listProduct = pe.Pets.ToList();
            return View();
        }

        public ActionResult Product()
        {
            ViewBag.listProduct = pe.Products.ToList();
            return View();
        }

        public ActionResult Trainer()
        {
            ViewBag.listProduct = pe.Trainers.ToList();
            return View();
        }

        public ActionResult  Shop()
        {
            return View();
        }
    }
}