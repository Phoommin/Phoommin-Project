using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace FinalProjectPetey.Controllers
{
    public class AdminController : Controller
    {
        // GET: Admin
        public ActionResult Admin()
        {
            return View();
        }

        public ActionResult Shop()
        {
            return View();
        }

        public ActionResult ManagUser()
        {
            return View();
        }
    }
}