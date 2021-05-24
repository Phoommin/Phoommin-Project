using System;
using System.Collections.Generic;
using System.Globalization;
using System.Linq;
using System.Threading;
using System.Web;
using System.Web.Mvc;
using SynchrotronHR.Models;

namespace SynchrotronHR.Controllers
{
    public class HomeController : Controller
    {
        HRISEntities db = new HRISEntities();

        // GET: Home
        public ActionResult Index()
        {
            var Language = Request.Cookies["Language"];
            if (Language == null || Language.Value == "")
            {
                Change("th", "Index");
                Request.Cookies["Language"].Value = "th";
                Language = Request.Cookies["Language"];
            }
            return View();
        }
        public ActionResult About()
        {
            ViewBag.Message = "Your application description page.";
            return View();
        }

        public ActionResult Contact()
        {
            ViewBag.Message = "Contact Page";
            return View();
        }

        public ActionResult CheckIfSessionValid()
        {
            if (Session["EmpID"] == null)
            {
                Session.RemoveAll();
                Session.Abandon();
                return Json("False");
            }

            return Json("True");
        }

        public ActionResult LoginView()
        {
            Session["EmpType"] = null;
            Session["mangerEmpID"] = null;
            Session["EmpName"] = null;
            Session["EmpID"] = null;
            return View();
        }

        public ActionResult Login(FormCollection fc)
        {
            using (HRISEntities db = new HRISEntities())
            {
                List<Employee> employees = db.Employees.ToList();
                List<JAManagerFlowApprove> JAManagerFlowApproves = db.JAManagerFlowApproves.ToList();

                var managerName = from e in employees
                                  join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                  from d in table1.ToList()
                                  select new JaManager
                                  {
                                      employees = e,
                                      JAManagerFlowApproves = d
                                  };

                var managerName1 = managerName.OrderBy(a => a.employees.FirstNameTH);

                var managerName2 = managerName1.Select(s => new JAManagerFlowApprove
                {
                    firstNameTH = s.employees.TitleTH + s.employees.FirstNameTH + "  " + s.employees.LastNameTH,
                    id = s.JAManagerFlowApproves.id,
                    mangerEmpID = s.JAManagerFlowApproves.mangerEmpID
                });

                string username = fc["taUsername"];
                var checkLogin = db.Employees.Where(a => a.FirstNameEN == username).Count();


                if (checkLogin != 0)
                {
                    var userDetails = db.Employees.Where(a => a.FirstNameEN == username).Single();
                    string name = userDetails.TitleTH + userDetails.FirstNameTH + " " + userDetails.LastNameTH;

                    Session["CheckLV1"] = "0";
                    Session["EmpID"] = userDetails.EmpID;
                    Session["EmpName"] = name;
                    var managerCheckNull = managerName2.Where(a => a.mangerEmpID == userDetails.EmpID).Count();

                    if (managerCheckNull != 0)
                    {
                        var managerName3 = managerName2.Where(a => a.mangerEmpID == userDetails.EmpID).Single();
                        Session["EmpType"] = "head";                                           
                    }
                    else
                    {
                        Session["EmpType"] = "not head";
                    }
                    Session["CheckSesWeight"] = "1";
 
                    return RedirectToAction("Index");
                }
                else if (username == "admin" || username == "Admin")
                {
                    Session["EmpID"] = "Admin";
                    Session["EmpName"] = "Admin";

                    return RedirectToAction("Index");
                }
                else
                {
                    return Redirect(Request.UrlReferrer.ToString());
                }
            }
        }

        public ActionResult LoginAdminView()
        {
            return View();
        }

        public ActionResult LoginAdmin(FormCollection fc)
        {
            string admin = fc["taUsername"];
                if (admin == "Jedsada" || admin == "Tichapat")
                {
                    Session["EmpID"] = "Admin";
                    Session["EmpName"] = "Admin";
                    
                    return RedirectToAction("Index");
                }
                else
                {
                    return Redirect(Request.UrlReferrer.ToString());
                }            
        }

        public ActionResult Logout()
        {
            Session["EmpType"] = null;
            Session["mangerEmpID"] = null;
            Session["EmpName"] = null;
            Session["EmpID"] = null;
            Session.RemoveAll();
            Session.Abandon();
            //Session["txtWeightKpiCheck"] = null;
            //Session["txtWeightKeyCheck"] = null;
            //Session["txtWeightSecCheck"] = null;
            //Session["txtWeightOtherCheck"] = null;
            return RedirectToAction("Index");
        }


            public ActionResult Change(string lang, string pages)
        {
            if (lang != null)
            {

                Thread.CurrentThread.CurrentCulture = CultureInfo.CreateSpecificCulture(lang);
                Thread.CurrentThread.CurrentUICulture = new CultureInfo(lang);
            }
            else
            {
                Thread.CurrentThread.CurrentCulture = CultureInfo.CreateSpecificCulture("th");
                Thread.CurrentThread.CurrentUICulture = new CultureInfo("th");
            }
            HttpCookie cookie = new HttpCookie("Language");
            cookie.Value = lang;
            Response.Cookies.Add(cookie);

            return View(pages);
        }
    }

}