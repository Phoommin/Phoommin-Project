using Antlr.Runtime;
using FinalProjectPetey.Models;
using System;
using System.Activities.Statements;
using System.Collections.Generic;
using System.Data.Entity;
using System.IO;
using System.Linq;
using System.Net;
using System.Threading.Tasks;
using System.Web;
using System.Web.Mvc;
using System.Web.Optimization;
using static FinalProjectPetey.Models.RegistershopViewModel;

namespace FinalProjectPetey.Controllers
{
    public class AccountController : Controller
    {

        PeteyEntities Re = new PeteyEntities();
        // GET: Account
        public ActionResult Index()
        {
            return View();
        }
        public ActionResult Registers()
        {
            return View();
        }

        public ActionResult resetpassword1()
        {
            return View();
        }

        public ActionResult resetpassword2()
        {
            return View();
        }

        public ActionResult Login()
        {
            return View();
        }

        public ActionResult accept()
        {
            return View();
        }

        public ActionResult accepts()
        {
            return View();
        }

        public ActionResult Condition()
        {
            return View();
        }

        public ActionResult Conditiontwo()
        {
            return View();
        }
        public ActionResult Rsellproduct()
        {
            return View();
        }

        public ActionResult EditUser(int id)
        {
            var datebyid = Re.customers.Single(x => x.Customer_Id == id);
            return View(datebyid);
        }

        [HttpPost]
        [AllowAnonymous]
        [ValidateAntiForgeryToken]
        public ActionResult Registers(RegisterViewModel model, FormCollection fc)
        {
            try
            {
                string date = fc["Birthdate"];
                customer cus = new customer();
                cus.Username = fc["Username"];
                cus.Password = fc["Password"];
                cus.ConfirmPassword = fc["ConfirmPassword"];
                cus.E_mail = fc["E_mail"];
                cus.Fullname = fc["Fullname"];
                cus.Sex = fc["Sex"];
                cus.Birthdate = Convert.ToDateTime(date);
                cus.Phone_No = fc["Phone_No"];
                cus.Address = fc["Address"];
                cus.UserType = "User";
                Re.customers.Add(cus);
                Re.SaveChanges();
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
            return View("Conditiontwo");
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Rsellproduct(int id ,FormCollection fc)
        {
            try
            {
                //string iframe = fc["iframe"];
               // var cus2 = (customer)Session["UserID"];
                customer cus = Re.customers.Where(a => a.Customer_Id == id).Single(); ;

                if (ModelState.IsValid)
                {
                    var file = Request.Files[0];
                    if (file != null & file.ContentLength > 0)
                    {
                        var fileName = Path.GetFileName(file.FileName);
                        var path = Path.Combine(Server.MapPath("~/Content/images/images_Shop"), fileName);
                        file.SaveAs(path);
                        cus.Images = fileName;
                    }
                }
                cus.Shop_name = fc["Shop_name"];
                cus.Name_Bank = fc["Name_Bank"];
                cus.Name_Owner = fc["Name_Owner"];
                cus.Card_No = fc["Card_No"];
                cus.Id_Bank = fc["Id_Bank"];
                cus.UserType = "Shop";
                Re.Entry(cus).State = EntityState.Modified;
                //Re.customers.Add(cus);
                Re.SaveChanges();
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
            Session["Shop_name"] = "0";
            Session["UserName"] = null;
            Session["UserType"] = null;
            return RedirectToAction("Conditiontwo", "Account", new { area = "" });
            //return View("Conditiontwo");
        }

        //private void ConfigureViewModel(RegistershopViewModel model)
        //{
        //    IEnumerable<Productss> products = Repository.FetchProducts();
        //    model.ProductList = new SelectList(products, "ID", "Name");
        //}


        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Login(customer objUser)
        {
            if (ModelState.IsValid)
            {
                using (PeteyEntities db = new PeteyEntities())
                {
                    var obj = db.customers.Where(a => a.Username.Equals(objUser.Username) && a.Password.Equals(objUser.Password)).FirstOrDefault();
                    if (obj != null)
                    {                      
                        Session["UserID"] = obj.Customer_Id;
                        Session["UserName"] = obj.Username;
                        Session["UserType"] = obj.UserType;
                        if (obj.Shop_name == null  && obj.Username != "admin")
                        {
                            Session["Shop_name"] = "1";
                            return RedirectToAction("Condition", "Account", new { area = "" });
                        }
                        else if(obj.Username == "admin")
                        {
                            Session["Shop_name"] = "2";
                            return RedirectToAction("Admin", "Admin", new { area = "" });
                        }else if(obj.Shop_name != null)
                        {
                            Session["Shop_name"] = "3";
                            return RedirectToAction("Index", "Home", new { area = "" });
                        }
                        else
                        {

                        }                    
                    }
                }
            }
            return View(objUser);
        }

        public ActionResult Logout()
        {
            Session["Shop_name"] = "0";
            Session["UserName"] = null;
            Session["UserType"] = null;
            return RedirectToAction("Index", "Home", new { area = "" });          
        }


        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult resetpassword1(FormCollection fc)
        {

            return View("resetpassword2");
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult resetpassword2(FormCollection fc)
        {
            return View("Login");
        }
    }
}