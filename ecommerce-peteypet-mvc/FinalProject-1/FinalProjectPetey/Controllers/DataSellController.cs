using FinalProjectPetey.Models;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace FinalProjectPetey.Controllers
{
  // [SessionState(System.Web.SessionState.SessionStateBehavior.Disabled)]
    public class DataSellController : Controller
    {
        PeteyEntities Cp = new PeteyEntities();
        // GET: Filter
        public ActionResult Index()
        {
            return View();
        }

        public ActionResult CreatePet()
        {
            return View();
        }


        [HttpPost]
        [AllowAnonymous]
        [ValidateAntiForgeryToken]
        public ActionResult CreatePet(int id, FormCollection fc )
        {
            try
            {
                string date = fc["Birthdate"];
                string Price = fc["Price"];
                Pet pet = new Pet();

                if (ModelState.IsValid)
                {
                    var file = Request.Files[0];
                    if (file != null & file.ContentLength > 0)
                    {
                        var fileName = Path.GetFileName(file.FileName);
                        var path = Path.Combine(Server.MapPath("~/Content/images/images_pet"), fileName);
                        file.SaveAs(path);
                        pet.Images = fileName;
                    }
                }
                pet.Name = fc["Name"];
                pet.Customer_id = id;
                pet.Price = Convert.ToDecimal(Price);
                pet.Sex = fc["Sex"];
                pet.Birthdate = Convert.ToDateTime(date);
                pet.Gene = fc["Gene"];
                pet.History = fc["History"];
                //pet.Type = fc["Type"];
                Cp.Pets.Add(pet);
                Cp.SaveChanges();
            }
            catch (System.Data.Entity.Validation.DbEntityValidationException dbEx)
            {
                Exception raise = dbEx;
                foreach (var validationErrors in dbEx.EntityValidationErrors)
                {
                    foreach (var validationError in validationErrors.ValidationErrors)
                    {
                        string message = string.Format("{0}:{1}",
                            validationErrors.Entry.Entity.ToString(),
                            validationError.ErrorMessage);
                        // raise a new exception nesting
                        // the current instance as InnerException
                        raise = new InvalidOperationException(message, raise);
                    }
                }
                throw raise;
            }
            return View("Condition");
        }

        public ActionResult CreateProduct()
        {
            return View();
        }

        [HttpPost]
        [AllowAnonymous]
        [ValidateAntiForgeryToken]
        public ActionResult CreaterProduct(FormCollection fc)
        {
            try
            {
                var Sesion = Session["User_id"];
                string date = fc["Birthdate"];
                string Price = fc["Price"];
                string date2 = fc["Exp_date"];
                Product pro = new Product();
                pro.Name = fc["Name"];
                pro.Customer_id = Convert.ToInt16(Session);
                pro.Price = Convert.ToDecimal(Price);
                pro.Pro_date = Convert.ToDateTime(date);
                pro.Exp_date = Convert.ToDateTime(date2);
                pro.Brand = fc["Brand"];
                pro.Detalis = fc["Detalis"];
                if (ModelState.IsValid)
                {
                    var file = Request.Files[0];
                    if (file != null & file.ContentLength > 0)
                    {
                        var fileName = Path.GetFileName(file.FileName);
                        var path = Path.Combine(Server.MapPath("~/Content/images/images_product"), fileName);
                        file.SaveAs(path);
                        pro.Images = fileName;
                    }
                }
                //pro.Type = fc["Type"];
                Cp.Products.Add(pro);
                Cp.SaveChanges();
            }
            catch (System.Data.Entity.Validation.DbEntityValidationException dbEx)
            {
                Exception raise = dbEx;
                foreach (var validationErrors in dbEx.EntityValidationErrors)
                {
                    foreach (var validationError in validationErrors.ValidationErrors)
                    {
                        string message = string.Format("{0}:{1}",
                            validationErrors.Entry.Entity.ToString(),
                            validationError.ErrorMessage);
                        // raise a new exception nesting
                        // the current instance as InnerException
                        raise = new InvalidOperationException(message, raise);
                    }
                }
                throw raise;
            }
            return View("Condition");
        }

        public ActionResult CreateTrainer()
        {
            return View();
        }

        [HttpPost]
        [AllowAnonymous]
        [ValidateAntiForgeryToken]
        public ActionResult CreateTrainer(RegisterViewModel model, FormCollection fc)
        {
            try
            {
                var Sesion = Session["User_id"];
                string date = fc["Birthdate"];
                string Price = fc["Price"];
                Pet pet = new Pet();
                pet.Name = fc["Name"];
                pet.Customer_id = Convert.ToInt16(Session);
                pet.Price = Convert.ToDecimal(Price);
                pet.Sex = fc["Sex"];
                pet.Birthdate = Convert.ToDateTime(date);
                pet.Gene = fc["Gene"];
                pet.History = fc["History"];
                if (ModelState.IsValid)
                {
                    var file = Request.Files[0];
                    if (file != null & file.ContentLength > 0)
                    {
                        var fileName = Path.GetFileName(file.FileName);
                        var path = Path.Combine(Server.MapPath("~/Content/images"), fileName);
                        file.SaveAs(path);
                        pet.Images = fileName;
                    }
                }
                Cp.Pets.Add(pet);
                Cp.SaveChanges();
            }
            catch (System.Data.Entity.Validation.DbEntityValidationException dbEx)
            {
                Exception raise = dbEx;
                foreach (var validationErrors in dbEx.EntityValidationErrors)
                {
                    foreach (var validationError in validationErrors.ValidationErrors)
                    {
                        string message = string.Format("{0}:{1}",
                            validationErrors.Entry.Entity.ToString(),
                            validationError.ErrorMessage);
                        // raise a new exception nesting
                        // the current instance as InnerException
                        raise = new InvalidOperationException(message, raise);
                    }
                }
                throw raise;
            }
            return View("Condition");
        }

        public ActionResult Updatepic()
        {
            return View();
        }

        public ActionResult MenuAdd()
        {           
            return View("MenuAdd");
        }

        public ActionResult Addpic()
        {
            return View();
        }
    }
}