using SynchrotronHR.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace SynchrotronHR.Controllers
{
    public class JobDescriptionController : Controller
    {
        HRISEntities jd = new HRISEntities();
        // GET: JobDescription
        public ActionResult JD(int jdId)
        { 
            if (Session["EmpID"] != null)
            {
                using (HRISEntities db = new HRISEntities())
                {
                    List<Employee> employees = db.Employees.ToList();
                    List<JDMasterEmp> jdMasterEmp = db.JDMasterEmps.ToList();
                    List<JDMaster> jdMaster = db.JDMasters.ToList();

                    var JDMasterEmpDetails = from e in employees
                                             join d in jdMasterEmp on e.EmpID equals d.empId into table1
                                             from d in table1.ToList()
                                             join i in jdMaster on d.jdId equals i.id into table2
                                             from i in table2.ToList()
                                             where e.EmpID == Session["EmpID"].ToString()
                                             where i.id == jdId  //UserID session
                                             select new ViewModel
                                             {
                                                 employees = e,
                                                 jdMasterEmp = d,
                                                 jdMaster = i
                                             };

                    var jdDetails = JDMasterEmpDetails.Single();
   

                    int jaDetails = db.JAMasters.Where(a => a.masterEmpId == jdDetails.jdMasterEmp.id).Count();

                    if (jaDetails == 0) {
                        Session["jaBtnCheck"] = "0";
                    }
                    else
                    {
                        Session["jaBtnCheck"] = "1";
                        var jaDetailsCheck = db.JAMasters.Where(a => a.masterEmpId == jdDetails.jdMasterEmp.id).Single();
                        if(jaDetailsCheck.jaStatus == "Waiting" || jaDetailsCheck.jaStatus == "Approved")
                        {
                            Session["jaStatusCheck"] = "W";
                        }
                        else
                        {
                            Session["jaStatusCheck"] = "D";
                        }
                        ViewData["jaDetails"] = jaDetailsCheck;
                    }
                    

                    ViewData["jdDetails"] = jdDetails;
                    Session["jdId"] = jdId;
                    Session["Alert"] = "0";
                    ViewBag.KeySub = db.JDMasterSubs.Where(a => a.jdMasterId == jdId).ToList();
                    return View(JDMasterEmpDetails);
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult JDSearch()
        {
            if (Session["EmpID"] != null)
            {
                using (HRISEntities db = new HRISEntities())
                {
                    List<Employee> employees = db.Employees.ToList();
                    List<JDMasterEmp> jdMasterEmp = db.JDMasterEmps.ToList();
                    List<JDMaster> jdMaster = db.JDMasters.ToList();

                    var JdSearchDetails = from e in employees
                                          join d in jdMasterEmp on e.EmpID equals d.empId into table1
                                          from d in table1.ToList()
                                          join i in jdMaster on d.jdId equals i.id into table2
                                          from i in table2.ToList()
                                          where e.EmpID == Session["EmpID"].ToString()
                                          where d.isActive == "A"  //UserID session
                                          select new ViewModel
                                          {
                                              employees = e,
                                              jdMasterEmp = d,
                                              jdMaster = i
                                          }; ;

                    ViewBag.jdSearchDetails = JdSearchDetails.First();
                    ViewBag.jdSearchDetailsList = JdSearchDetails.ToList();
                    return View(JdSearchDetails);
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

    }
}