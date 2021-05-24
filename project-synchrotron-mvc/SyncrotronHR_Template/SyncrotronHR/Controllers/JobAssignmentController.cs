using CrystalDecisions.CrystalReports.Engine;
using SynchrotronHR.Models;
using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using PagedList.Mvc;

using System.IO;
using SynchrotronHR.Report;
using PagedList;

namespace SynchrotronHR.Controllers
{  
    public class JobAssignmentController : Controller
    {
        HRISEntities db = new HRISEntities();
        // GET: JobAssignment

        public ActionResult JA(int jdId)
        {
            if (Session["EmpID"] != null)
            {
                if (Session["EmpType"].ToString() == "head")
                {
                    using (HRISEntities db = new HRISEntities())
                    {
                        List<Employee> employees = db.Employees.ToList();
                        List<JDMasterEmp> jdMasterEmp = db.JDMasterEmps.ToList();
                        List<JDMaster> jdMaster = db.JDMasters.ToList();
                        List<JAMaster> jaMaster = db.JAMasters.ToList();
                        List<JAManagerFlowApprove> JAManagerFlowApproves = db.JAManagerFlowApproves.ToList();
                        List<View_JAManagerFlowApprove> V_JAManagerFlowApproves = db.View_JAManagerFlowApprove.ToList();

                        var JAMasterEmpDetails = from e in employees
                                                 join d in jdMasterEmp on e.EmpID equals d.empId into table1
                                                 from d in table1.ToList()
                                                 join i in jdMaster on d.jdId equals i.id into table2
                                                 from i in table2.ToList()
                                                 where e.EmpID == Session["EmpID"].ToString()
                                                 where d.jdId == jdId  //UserID session
                                                 select new ViewModel
                                                 {
                                                     employees = e,
                                                     jdMasterEmp = d,
                                                     jdMaster = i
                                                 };

                        List<JAMasterKPIDetail> KPIs = db.JAMasterKPIDetails.ToList();
                        var JAMasterKPIDetail = from e in employees
                                                join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                from d in table1.ToList()
                                                join k in KPIs on d.id equals k.directorId into table2
                                                from k in table2.ToList()
                                                select new JoinKpi
                                                {
                                                    Kpi = k,
                                                    employees = e,
                                                    JAManagerFlowApproves = d
                                                };

                        List<JAMasterKeyResponsibilitiesDetail> KEYs = db.JAMasterKeyResponsibilitiesDetails.ToList();
                        var JAMasterKeyResponsibilitiesDetail = from e in employees
                                                                join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                                from d in table1.ToList()
                                                                join k in KEYs on d.id equals k.directorId into table2
                                                                from k in table2.ToList()
                                                                select new JoinKey
                                                                {
                                                                    Key = k,
                                                                    employees = e,
                                                                    JAManagerFlowApproves = d
                                                                };

                        List<JAMasterSecondaryActivitiesDetail> SECs = db.JAMasterSecondaryActivitiesDetails.ToList();
                        var JAMasterSecondaryActivitiesDetail = from e in employees
                                                                join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                                from d in table1.ToList()
                                                                join k in SECs on d.id equals k.directorId into table2
                                                                from k in table2.ToList()
                                                                select new JoinSec
                                                                {
                                                                    Sec = k,
                                                                    employees = e,
                                                                    JAManagerFlowApproves = d
                                                                };

                        List<JAMasterOtherActivitiesDetail> OTHERs = db.JAMasterOtherActivitiesDetails.ToList();
                        var JAMasterOtherActivitiesDetail = from e in employees
                                                            join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                            from d in table1.ToList()
                                                            join k in OTHERs on d.id equals k.directorId into table2
                                                            from k in table2.ToList()
                                                            select new JoinOther
                                                            {
                                                                Other = k,
                                                                employees = e,
                                                                JAManagerFlowApproves = d
                                                            };

                        List<JAMasterExtraDetail> EXTRAs = db.JAMasterExtraDetails.ToList();
                        var JAMasterExtraDetail = from e in employees
                                                  join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                  from d in table1.ToList()
                                                  join k in EXTRAs on d.id equals k.directorId into table2
                                                  from k in table2.ToList()
                                                  select new JoinExtra
                                                  {
                                                      Extra = k,
                                                      employees = e,
                                                      JAManagerFlowApproves = d
                                                  };

                        var managerName = from e in employees
                                          join d in JAManagerFlowApproves on e.DirectorID equals d.id into table1
                                          from d in table1.ToList()
                                          where e.EmpID == Session["EmpID"].ToString()
                                          select new JaManager
                                          {
                                              employees = e,
                                              JAManagerFlowApproves = d
                                          };


                        var jd = JAMasterEmpDetails.Single();
                        var ja = db.JAMasters.Where(a => a.masterEmpId == jd.jdMasterEmp.id).Single();
                        ViewData["jaDetails"] = ja;
                        var mangerNameId = managerName.Single();


                        var CheckLV1 = db.View_JAManagerFlowApprove.Where(a => a.mangerEmpID == jd.employees.EmpID).Single();

                        var ManagerNameLV0 = from m in V_JAManagerFlowApproves
                                             join e in employees on m.mangerLV0ID equals e.EmpID
                                             where m.id == jd.employees.DirectorID
                                             select new
                                             {
                                                 mid = m.id,
                                                 managerLV0ID = m.mangerLV0ID,
                                                 managerNameLV0 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
                                                 Position = e.Position
                                             };

                       
                        
                        var ManagerNameLV2 = from m in V_JAManagerFlowApproves
                                             join e in employees on m.Expr2 equals e.EmpID
                                             where m.id == jd.employees.DirectorID
                                             select new
                                             {
                                                 mid = m.id,
                                                 managerLV2ID = m.Expr2,
                                                 managerNameLV2 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
                                                 Position = e.Position
                                             };

                        //var ManagerNameLV2 = from m in V_JAManagerFlowApproves
                        //                     join e in employees on m.mangerEmpID equals e.EmpID into table1
                        //                     from e in table1.ToList()
                        //                     join lv1 in ManagerNameLV1 on m.id equals lv1.mid into table2
                        //                     from lv1 in table2.ToList()
                        //                     join lv0 in ManagerNameLV0 on m.id equals lv0.mid into table3
                        //                     from lv0 in table3.ToList()
                        //                     where m.id == jd.employees.DirectorID
                        //                     select new
                        //                     {
                        //                         _mid = m.id,
                        //                         _managerLV2ID = m.mangerEmpID,
                        //                         _managerNameLV2 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
                        //                         _managerLV2Position = e.Position,

                        //                         _managerLV1ID = lv1.managerLV1ID,
                        //                         _managerNameLV1 = lv1.managerNameLV1,
                        //                         _managerLV1Position = lv1.Position,

                        //                         _managerLV0ID = lv0.managerLV0ID,
                        //                         _managerNameLV0 = lv0.managerNameLV0,
                        //                         _managerLV0Position = lv0.Position
                        //                     };

                        var Mn0 = ManagerNameLV0.Single();
                        
                        var Mn2 = ManagerNameLV2.Single();

                        //var InManager2 = new InManager2
                        //{
                        //    inManager = new[]
                        //        {
                        //        new InManager { _mid = Mn._mid },
                        //        new InManager { _managerLV2ID = Mn._managerLV2ID },
                        //        new InManager { _managerNameLV2 = Mn._managerNameLV2 },
                        //        new InManager { _managerLV2Position = Mn._managerLV2Position },

                        //        new InManager { _managerLV1ID = Mn._managerLV1ID },
                        //        new InManager { _managerNameLV1 = Mn._managerNameLV1 },
                        //        new InManager { _managerLV1Position = Mn._managerLV1Position },

                        //        new InManager { _managerLV0ID = Mn._managerLV0ID },
                        //        new InManager { _managerNameLV0 = Mn._managerNameLV0 },
                        //        new InManager { _managerLV0Position = Mn._managerLV0Position }
                        //    }.Where(a => a._mid == jd.employees.DirectorID).Single()
                        //};


                        //List<InManager2> inManager = InManager2.inManager.;

                        //ViewBag.DirectorSection = DirectorSection.OrderBy(a => a.employees.FirstNameTH).ToList(); หัวหน้าตามสายงาน
                        ViewBag._managerNameLV2 = Mn2.managerNameLV2;
                        ViewBag._managerLV2Position = Mn2.Position;

                        ViewBag._managerNameLV1 = "0";
                        ViewBag._managerLV1Position = "0";

                        ViewBag._managerNameLV0 = Mn0.managerNameLV0;
                        ViewBag._managerLV0Position = Mn0.Position;

                        if (CheckLV1.ManagerNameLV1 != null)
                        {
                            var ManagerNameLV1 = from m in V_JAManagerFlowApproves
                                                 join e in employees on m.mangerLV1ID equals e.EmpID
                                                 where m.mangerEmpID == jd.employees.EmpID
                                                 select new
                                                 {
                                                     mid = m.id,
                                                     managerLV1ID = m.mangerLV1ID,
                                                     managerNameLV1 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
                                                     Position = e.Position
                                                 };

                            Session["CheckLV1"] = "CheckLV1";
                            var Mn1 = ManagerNameLV1.Single();
                            ViewBag._managerNameLV1 = Mn1.managerNameLV1;
                            ViewBag._managerLV1Position = Mn1.Position;
                        }

                        //ViewBag.NameDirector2 = db.Employees.Where(a => a.EmpID == mangerNameId.JAManagerFlowApproves.mangerEmpID && ).Single(); หัวหน้าส่วน
                        ViewBag.listKpi = JAMasterKPIDetail.Where(a => a.Kpi.isStatus == "A" && a.Kpi.jaMasterId == ja.id).ToList();
                        ViewBag.listKey = JAMasterKeyResponsibilitiesDetail.Where(a => a.Key.isStatus == "A" && a.Key.jaMasterId == ja.id).OrderBy(a => a.Key.levelDisplay).ThenBy(a => a.Key.id).ToList();
                        ViewBag.listSecondKey = JAMasterSecondaryActivitiesDetail.Where(a => a.Sec.isStatus == "A" && a.Sec.jaMasterId == ja.id).ToList();
                        ViewBag.listOtherKey = JAMasterOtherActivitiesDetail.Where(a => a.Other.isStatus == "A" && a.Other.jaMasterId == ja.id).ToList();
                        ViewBag.listExtraKey = JAMasterExtraDetail.Where(a => a.Extra.isStatus == "A" && a.Extra.jaMasterId == ja.id).ToList();
                        return View(JAMasterEmpDetails);
                    }
                 }
                else
                {
                    Session["CheckLV1"] = "CheckLV1";
                    using (HRISEntities db = new HRISEntities())
                    {
                        List<Employee> employees = db.Employees.ToList();
                        List<JDMasterEmp> jdMasterEmp = db.JDMasterEmps.ToList();
                        List<JDMaster> jdMaster = db.JDMasters.ToList();
                        List<JAMaster> jaMaster = db.JAMasters.ToList();
                        List<JAManagerFlowApprove> JAManagerFlowApproves = db.JAManagerFlowApproves.ToList();

                        var JAMasterEmpDetails = from e in employees
                                                 join d in jdMasterEmp on e.EmpID equals d.empId into table1
                                                 from d in table1.ToList()
                                                 join i in jdMaster on d.jdId equals i.id into table2
                                                 from i in table2.ToList()
                                                 where e.EmpID == Session["EmpID"].ToString()
                                                 where d.jdId == jdId  //UserID session
                                                 select new ViewModel
                                                 {
                                                     employees = e,
                                                     jdMasterEmp = d,
                                                     jdMaster = i
                                                 };

                        List<JAMasterKPIDetail> KPIs = db.JAMasterKPIDetails.ToList();
                        var JAMasterKPIDetail = from e in employees
                                                join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                from d in table1.ToList()
                                                join k in KPIs on d.id equals k.directorId into table2
                                                from k in table2.ToList()
                                                select new JoinKpi
                                                {
                                                    Kpi = k,
                                                    employees = e,
                                                    JAManagerFlowApproves = d
                                                };

                        List<JAMasterKeyResponsibilitiesDetail> KEYs = db.JAMasterKeyResponsibilitiesDetails.ToList();
                        var JAMasterKeyResponsibilitiesDetail = from e in employees
                                                                join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                                from d in table1.ToList()
                                                                join k in KEYs on d.id equals k.directorId into table2
                                                                from k in table2.ToList()
                                                                select new JoinKey
                                                                {
                                                                    Key = k,
                                                                    employees = e,
                                                                    JAManagerFlowApproves = d
                                                                };

                        List<JAMasterSecondaryActivitiesDetail> SECs = db.JAMasterSecondaryActivitiesDetails.ToList();
                        var JAMasterSecondaryActivitiesDetail = from e in employees
                                                                join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                                from d in table1.ToList()
                                                                join k in SECs on d.id equals k.directorId into table2
                                                                from k in table2.ToList()
                                                                select new JoinSec
                                                                {
                                                                    Sec = k,
                                                                    employees = e,
                                                                    JAManagerFlowApproves = d
                                                                };

                        List<JAMasterOtherActivitiesDetail> OTHERs = db.JAMasterOtherActivitiesDetails.ToList();
                        var JAMasterOtherActivitiesDetail = from e in employees
                                                            join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                            from d in table1.ToList()
                                                            join k in OTHERs on d.id equals k.directorId into table2
                                                            from k in table2.ToList()
                                                            select new JoinOther
                                                            {
                                                                Other = k,
                                                                employees = e,
                                                                JAManagerFlowApproves = d
                                                            };

                        List<JAMasterExtraDetail> EXTRAs = db.JAMasterExtraDetails.ToList();
                        var JAMasterExtraDetail = from e in employees
                                                  join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                  from d in table1.ToList()
                                                  join k in EXTRAs on d.id equals k.directorId into table2
                                                  from k in table2.ToList()
                                                  select new JoinExtra
                                                  {
                                                      Extra = k,
                                                      employees = e,
                                                      JAManagerFlowApproves = d
                                                  };

                        var managerName = from e in employees
                                          join d in JAManagerFlowApproves on e.DirectorID equals d.id into table1
                                          from d in table1.ToList()
                                          where e.EmpID == Session["EmpID"].ToString()
                                          select new JaManager
                                          {
                                              employees = e,
                                              JAManagerFlowApproves = d
                                          };


                        var jd = JAMasterEmpDetails.Single();
                        var ja = db.JAMasters.Where(a => a.masterEmpId == jd.jdMasterEmp.id).Single();
                        ViewData["jaDetails"] = ja;
                        var mangerNameId = managerName.Single();

                        //--------------------------------------------------หัวหน้าตามสายงาน-------------------------------------------------------------
                        //var DirectorSectionInWorkTable = (from s1 in db.JAMasterKPIDetails where s1.isStatus == "A" && s1.jaMasterId == ja.id
                        //                                  select new 
                        //                       {
                        //                           directorID = s1.directorId
                        //                       }).Distinct().ToList()
                        //                       .Union(from s2 in db.JAMasterKeyResponsibilitiesDetails where s2.isStatus == "A" && s2.jaMasterId == ja.id
                        //                              select new
                        //                       {
                        //                           directorID = s2.directorId
                        //                       }).Distinct().ToList()
                        //                       .Union(from s3 in db.JAMasterSecondaryActivitiesDetails where s3.isStatus == "A" && s3.jaMasterId == ja.id
                        //                              select new
                        //                       {
                        //                           directorID = s3.directorId
                        //                       }).Distinct().ToList()
                        //                       .Union(from s4 in db.JAMasterOtherActivitiesDetails where s4.isStatus == "A" && s4.jaMasterId == ja.id
                        //                              select new
                        //                       {
                        //                           directorID = s4.directorId
                        //                       }).Distinct().ToList() 
                        //                       .Union(from s5 in db.JAMasterExtraDetails where s5.isStatus == "A" && s5.jaMasterId == ja.id
                        //                              select new 
                        //                       {
                        //                           directorID = s5.directorId
                        //                       }).Distinct().ToList();

                        //var DirectorSection = from d in JAManagerFlowApproves
                        //                  join k in DirectorSectionInWorkTable on d.id equals k.directorID into table1
                        //                  from k in table1.ToList()
                        //                  join e in employees on d.mangerEmpID equals e.EmpID into table2
                        //                  from e in table2.ToList()
                        //                  select new JaManager
                        //                  {
                        //                      employees = e,
                        //                      JAManagerFlowApproves = d
                        //                  };
                        //--------------------------------------------------หัวหน้าตามสายงาน-------------------------------------------------------------


                        var ManagerNameLV0 = from m in JAManagerFlowApproves
                                             join e in employees on m.mangerLV0ID equals e.EmpID
                                             select new
                                             {
                                                 mid = m.id,
                                                 managerLV0ID = m.mangerLV0ID,
                                                 managerNameLV0 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
                                                 Position = e.Position
                                             };

                        var ManagerNameLV1 = from m in JAManagerFlowApproves
                                             join e in employees on m.mangerLV1ID equals e.EmpID
                                             select new
                                             {
                                                 mid = m.id,
                                                 managerLV1ID = m.mangerLV1ID,
                                                 managerNameLV1 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
                                                 Position = e.Position
                                             };



                        var ManagerNameLV2 = from m in JAManagerFlowApproves
                                             join e in employees on m.mangerEmpID equals e.EmpID into table1
                                             from e in table1.ToList()
                                             join lv1 in ManagerNameLV1 on m.id equals lv1.mid into table2
                                             from lv1 in table2.ToList()
                                             join lv0 in ManagerNameLV0 on m.id equals lv0.mid into table3
                                             from lv0 in table3.ToList()
                                             where m.id == jd.employees.DirectorID
                                             select new
                                             {
                                                 _mid = m.id,
                                                 _managerLV2ID = m.mangerEmpID,
                                                 _managerNameLV2 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
                                                 _managerLV2Position = e.Position,

                                                 _managerLV1ID = lv1.managerLV1ID,
                                                 _managerNameLV1 = lv1.managerNameLV1,
                                                 _managerLV1Position = lv1.Position,

                                                 _managerLV0ID = lv0.managerLV0ID,
                                                 _managerNameLV0 = lv0.managerNameLV0,
                                                 _managerLV0Position = lv0.Position
                                             };

                        var Mn = ManagerNameLV2.Single();

                        //var InManager2 = new InManager2
                        //{
                        //    inManager = new[]
                        //        {
                        //        new InManager { _mid = Mn._mid },
                        //        new InManager { _managerLV2ID = Mn._managerLV2ID },
                        //        new InManager { _managerNameLV2 = Mn._managerNameLV2 },
                        //        new InManager { _managerLV2Position = Mn._managerLV2Position },

                        //        new InManager { _managerLV1ID = Mn._managerLV1ID },
                        //        new InManager { _managerNameLV1 = Mn._managerNameLV1 },
                        //        new InManager { _managerLV1Position = Mn._managerLV1Position },

                        //        new InManager { _managerLV0ID = Mn._managerLV0ID },
                        //        new InManager { _managerNameLV0 = Mn._managerNameLV0 },
                        //        new InManager { _managerLV0Position = Mn._managerLV0Position }
                        //    }.Where(a => a._mid == jd.employees.DirectorID).Single()
                        //};


                        //List<InManager2> inManager = InManager2.inManager.;

                        //ViewBag.DirectorSection = DirectorSection.OrderBy(a => a.employees.FirstNameTH).ToList(); หัวหน้าตามสายงาน
                        ViewBag._managerNameLV2 = Mn._managerNameLV2;
                        ViewBag._managerLV2Position = Mn._managerLV2Position;

                        ViewBag._managerNameLV1 = Mn._managerNameLV1;
                        ViewBag._managerLV1Position = Mn._managerLV1Position;

                        ViewBag._managerNameLV0 = Mn._managerNameLV0;
                        ViewBag._managerLV0Position = Mn._managerLV0Position;

                        //ViewBag.NameDirector2 = db.Employees.Where(a => a.EmpID == mangerNameId.JAManagerFlowApproves.mangerEmpID && ).Single(); หัวหน้าส่วน
                        ViewBag.listKpi = JAMasterKPIDetail.Where(a => a.Kpi.isStatus == "A" && a.Kpi.jaMasterId == ja.id).ToList();
                        ViewBag.listKey = JAMasterKeyResponsibilitiesDetail.Where(a => a.Key.isStatus == "A" && a.Key.jaMasterId == ja.id).OrderBy(a => a.Key.levelDisplay).ThenBy(a => a.Key.id).ToList();
                        ViewBag.listSecondKey = JAMasterSecondaryActivitiesDetail.Where(a => a.Sec.isStatus == "A" && a.Sec.jaMasterId == ja.id).ToList();
                        ViewBag.listOtherKey = JAMasterOtherActivitiesDetail.Where(a => a.Other.isStatus == "A" && a.Other.jaMasterId == ja.id).ToList();
                        ViewBag.listExtraKey = JAMasterExtraDetail.Where(a => a.Extra.isStatus == "A" && a.Extra.jaMasterId == ja.id).ToList();
                        return View(JAMasterEmpDetails);
                    }
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
        }

        //public ActionResult JAForManager(int jdId)
        //{
        //    using (HRISEntities db = new HRISEntities())
        //    {
        //        List<Employee> employees = db.Employees.ToList();
        //        List<JDMasterEmp> jdMasterEmp = db.JDMasterEmps.ToList();
        //        List<JDMaster> jdMaster = db.JDMasters.ToList();
        //        List<JAMaster> jaMaster = db.JAMasters.ToList();
        //        List<JAManagerFlowApprove> JAManagerFlowApproves = db.JAManagerFlowApproves.ToList();

        //        var JAMasterEmpDetails = from e in employees
        //                                 join d in jdMasterEmp on e.EmpID equals d.empId into table1
        //                                 from d in table1.ToList()
        //                                 join i in jdMaster on d.jdId equals i.id into table2
        //                                 from i in table2.ToList()
        //                                 where e.EmpID == Session["EmpID"].ToString()
        //                                 where d.jdId == jdId  //UserID session
        //                                 select new ViewModel
        //                                 {
        //                                     employees = e,
        //                                     jdMasterEmp = d,
        //                                     jdMaster = i
        //                                 };

        //        List<JAMasterKPIDetail> KPIs = db.JAMasterKPIDetails.ToList();
        //        var JAMasterKPIDetail = from e in employees
        //                                join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
        //                                from d in table1.ToList()
        //                                join k in KPIs on d.id equals k.directorId into table2
        //                                from k in table2.ToList()
        //                                select new JoinKpi
        //                                {
        //                                    Kpi = k,
        //                                    employees = e,
        //                                    JAManagerFlowApproves = d
        //                                };

        //        List<JAMasterKeyResponsibilitiesDetail> KEYs = db.JAMasterKeyResponsibilitiesDetails.ToList();
        //        var JAMasterKeyResponsibilitiesDetail = from e in employees
        //                                                join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
        //                                                from d in table1.ToList()
        //                                                join k in KEYs on d.id equals k.directorId into table2
        //                                                from k in table2.ToList()
        //                                                select new JoinKey
        //                                                {
        //                                                    Key = k,
        //                                                    employees = e,
        //                                                    JAManagerFlowApproves = d
        //                                                };

        //        List<JAMasterSecondaryActivitiesDetail> SECs = db.JAMasterSecondaryActivitiesDetails.ToList();
        //        var JAMasterSecondaryActivitiesDetail = from e in employees
        //                                                join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
        //                                                from d in table1.ToList()
        //                                                join k in SECs on d.id equals k.directorId into table2
        //                                                from k in table2.ToList()
        //                                                select new JoinSec
        //                                                {
        //                                                    Sec = k,
        //                                                    employees = e,
        //                                                    JAManagerFlowApproves = d
        //                                                };

        //        List<JAMasterOtherActivitiesDetail> OTHERs = db.JAMasterOtherActivitiesDetails.ToList();
        //        var JAMasterOtherActivitiesDetail = from e in employees
        //                                            join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
        //                                            from d in table1.ToList()
        //                                            join k in OTHERs on d.id equals k.directorId into table2
        //                                            from k in table2.ToList()
        //                                            select new JoinOther
        //                                            {
        //                                                Other = k,
        //                                                employees = e,
        //                                                JAManagerFlowApproves = d
        //                                            };

        //        List<JAMasterExtraDetail> EXTRAs = db.JAMasterExtraDetails.ToList();
        //        var JAMasterExtraDetail = from e in employees
        //                                  join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
        //                                  from d in table1.ToList()
        //                                  join k in EXTRAs on d.id equals k.directorId into table2
        //                                  from k in table2.ToList()
        //                                  select new JoinExtra
        //                                  {
        //                                      Extra = k,
        //                                      employees = e,
        //                                      JAManagerFlowApproves = d
        //                                  };

        //        var managerName = from e in employees
        //                          join d in JAManagerFlowApproves on e.DirectorID equals d.id into table1
        //                          from d in table1.ToList()
        //                          where e.EmpID == Session["EmpID"].ToString()
        //                          select new JaManager
        //                          {
        //                              employees = e,
        //                              JAManagerFlowApproves = d
        //                          };

        //        var jd = JAMasterEmpDetails.Single();
        //        var ja = db.JAMasters.Where(a => a.masterEmpId == jd.jdMasterEmp.id).Single();
        //        ViewData["jaDetails"] = ja;
        //        var mangerNameId = managerName.Single();

        //        var ManagerNameLV0 = from m in JAManagerFlowApproves
        //                             join e in employees on m.mangerLV0ID equals e.EmpID
        //                             select new
        //                             {
        //                                 mid = m.id,
        //                                 managerLV0ID = m.mangerLV0ID,
        //                                 managerNameLV0 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
        //                                 Position = e.Position
        //                             };

        //        var ManagerNameLV1 = from m in JAManagerFlowApproves
        //                             join e in employees on m.mangerLV1ID equals e.EmpID
        //                             select new
        //                             {
        //                                 mid = m.id,
        //                                 managerLV1ID = m.mangerLV1ID,
        //                                 managerNameLV1 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
        //                                 Position = e.Position
        //                             };


        //        var ManagerNameLV2 = from m in JAManagerFlowApproves
        //                             join e in employees on m.mangerEmpID equals e.EmpID into table1
        //                             from e in table1.ToList()
        //                             join lv1 in ManagerNameLV1 on m.id equals lv1.mid into table2
        //                             from lv1 in table2.ToList()
        //                             join lv0 in ManagerNameLV0 on m.id equals lv0.mid into table3
        //                             from lv0 in table3.ToList()
        //                             where m.id == jd.employees.DirectorID
        //                             select new
        //                             {
        //                                 _mid = m.id,
        //                                 _managerLV2ID = m.mangerEmpID,
        //                                 _managerNameLV2 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
        //                                 _managerLV2Position = e.Position,

        //                                 _managerLV1ID = lv1.managerLV1ID,
        //                                 _managerNameLV1 = lv1.managerNameLV1,
        //                                 _managerLV1Position = lv1.Position,

        //                                 _managerLV0ID = lv0.managerLV0ID,
        //                                 _managerNameLV0 = lv0.managerNameLV0,
        //                                 _managerLV0Position = lv0.Position
        //                             };

        //        var Mn = ManagerNameLV2.Single();

        //        ViewBag._managerNameLV2 = Mn._managerNameLV2;
        //        ViewBag._managerLV2Position = Mn._managerLV2Position;

        //        ViewBag._managerNameLV1 = Mn._managerNameLV1;
        //        ViewBag._managerLV1Position = Mn._managerLV1Position;

        //        ViewBag._managerNameLV0 = Mn._managerNameLV0;
        //        ViewBag._managerLV0Position = Mn._managerLV0Position;

        //        ViewBag.listKpi = JAMasterKPIDetail.Where(a => a.Kpi.isStatus == "A" && a.Kpi.jaMasterId == ja.id).ToList();
        //        ViewBag.listKey = JAMasterKeyResponsibilitiesDetail.Where(a => a.Key.isStatus == "A" && a.Key.jaMasterId == ja.id).OrderBy(a => a.Key.levelDisplay).ThenBy(a => a.Key.id).ToList();
        //        ViewBag.listSecondKey = JAMasterSecondaryActivitiesDetail.Where(a => a.Sec.isStatus == "A" && a.Sec.jaMasterId == ja.id).ToList();
        //        ViewBag.listOtherKey = JAMasterOtherActivitiesDetail.Where(a => a.Other.isStatus == "A" && a.Other.jaMasterId == ja.id).ToList();
        //        ViewBag.listExtraKey = JAMasterExtraDetail.Where(a => a.Extra.isStatus == "A" && a.Extra.jaMasterId == ja.id).ToList();
        //        return View(JAMasterEmpDetails);
        //    }
        //}

        public ActionResult JaAdminSearch(string sortOrder, string currentFilter, string SearchStringName, string SearchStringYear, string SearchStringStatus, int? page)
        {
            if (Session["EmpID"] != null)
            {
                using (HRISEntities db = new HRISEntities())
                {
                    List<Employee> employees = db.Employees.ToList();
                    List<JDMasterEmp> jdMasterEmps = db.JDMasterEmps.ToList();
                    List<JAMaster> jaMasters = db.JAMasters.ToList();
                    List<JDMaster> jdMasters = db.JDMasters.ToList();

                    var jaMasterDetails = from e in employees
                                          join jde in jdMasterEmps on e.EmpID equals jde.empId into table2
                                          from jde in table2.ToList()
                                          join jd in jdMasters on jde.jdId equals jd.id into table3
                                          from jd in table3.ToList()
                                          join ja in jaMasters on jde.id equals ja.masterEmpId into table4
                                          from ja in table4.ToList()
                                          select new ForAdmin
                                          {
                                              employees = e,
                                              jdMasterEmp = jde,
                                              jaMaster = ja,
                                              jdMaster = jd
                                          };


                    ViewBag.CurrentSort = sortOrder;
                    ViewBag.jaIDSortParm = String.IsNullOrEmpty(sortOrder) ? "id_desc" : "";
                    ViewBag.fullNameSortParm = String.IsNullOrEmpty(sortOrder) ? "fullName_desc" : "";
                    ViewBag.jaYearSortParm = String.IsNullOrEmpty(sortOrder) ? "jaYear_desc" : "";
                    ViewBag.StatusSortParm = String.IsNullOrEmpty(sortOrder) ? "jaStatus_desc" : "";

                    if (SearchStringName != null)
                    {
                        page = 1;
                    }
                    else
                    {
                        SearchStringName = currentFilter;
                    }

                    ViewBag.CurrentFilter = SearchStringName;

                    var jaMaster = from s in jaMasterDetails
                                   select s;



                    if (!String.IsNullOrEmpty(SearchStringName) && !String.IsNullOrEmpty(SearchStringYear))
                    {
                        jaMaster = jaMaster.Where(s => s.jaMaster.fullname.Contains(SearchStringName) && s.jaMaster.jaYear.Contains(SearchStringYear));

                    }
                    else if (!String.IsNullOrEmpty(SearchStringName) && (!String.IsNullOrEmpty(SearchStringStatus) && SearchStringStatus != "selected"))
                    {
                        jaMaster = jaMaster.Where(s => s.jaMaster.fullname.Contains(SearchStringName) && s.jaMaster.jaStatus.Contains(SearchStringStatus));

                    }
                    else if (!String.IsNullOrEmpty(SearchStringYear) && (!String.IsNullOrEmpty(SearchStringStatus) && SearchStringStatus != "selected"))
                    {
                        jaMaster = jaMaster.Where(s => s.jaMaster.jaYear.Contains(SearchStringYear) && s.jaMaster.jaStatus.Contains(SearchStringStatus));
                    }
                    else if (!String.IsNullOrEmpty(SearchStringName) && !String.IsNullOrEmpty(SearchStringYear) && (!String.IsNullOrEmpty(SearchStringStatus) && SearchStringStatus != "selected"))
                    {
                        jaMaster = jaMaster.Where(s => s.jaMaster.fullname.Contains(SearchStringName)
                                                && s.jaMaster.jaYear.Contains(SearchStringYear)
                                                && s.jaMaster.jaStatus.Contains(SearchStringStatus));
                    }
                    else if (!String.IsNullOrEmpty(SearchStringName))
                    {
                        jaMaster = jaMaster.Where(s => s.jaMaster.fullname.Contains(SearchStringName));
                    }

                    else if (!String.IsNullOrEmpty(SearchStringYear))
                    {
                        jaMaster = jaMaster.Where(s => s.jaMaster.jaYear.Contains(SearchStringYear));
                    }

                    else if (!String.IsNullOrEmpty(SearchStringStatus) && SearchStringStatus != "selected")
                    {
                        jaMaster = jaMaster.Where(s => s.jaMaster.jaStatus.Contains(SearchStringStatus));
                    }


                    switch (sortOrder)
                    {
                        case "id_desc":
                            jaMaster = jaMaster.OrderByDescending(s => s.jaMaster.id);
                            break;
                        case "fullName_desc":
                            jaMaster = jaMaster.OrderByDescending(s => s.jaMaster.fullname);
                            break;
                        case "jaYear_desc":
                            jaMaster = jaMaster.OrderByDescending(s => s.jaMaster.jaYear);
                            break;
                        case "jaStatus_desc":
                            jaMaster = jaMaster.OrderByDescending(s => s.jaMaster.jaStatus);
                            break;
                        default:  // Name ascending 
                            jaMaster = jaMaster.OrderByDescending(s => s.jaMaster.id);
                            break;
                    }

                    int pageSize = 3;
                    int pageNumber = (page ?? 1);
                    return View(jaMaster.ToPagedList(pageNumber, pageSize));
                }
            }
            else
            {
                return View("../Home/LoginView");
            }           
        }


        public ActionResult JaHeadSearch(string sortOrder, string currentFilter, string SearchStringName, string SearchStringYear, string SearchStringStatus, int? page)
        {
            if (Session["EmpID"] != null)
            {
                using (HRISEntities db = new HRISEntities())
                {
                    List<Employee> employees = db.Employees.ToList();
                    List<JDMasterEmp> jdMasterEmp = db.JDMasterEmps.ToList();
                    List<JDMaster> jdMaster = db.JDMasters.ToList();
                    List<JAMaster> jaMaster = db.JAMasters.ToList();
                    List<JAManagerFlowApprove> JAManagerFlowApproves = db.JAManagerFlowApproves.ToList();

                    //var ManagerNameLV0 = from m in JAManagerFlowApproves
                    //                      join e in employees on m.mangerEmpID equals e.EmpID 
                    //                      select new 
                    //                      {
                    //                          mid = m.id,
                    //                          managerLV0ID = m.mangerLV1ID,
                    //                          managerNameLV0 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH
                    //                      };

                    //var ManagerNameLV1 = from m in JAManagerFlowApproves
                    //                     join e in employees on m.mangerEmpID equals e.EmpID
                    //                     select new
                    //                     {
                    //                         mid = m.id,
                    //                         managerLV1ID = m.mangerLV1ID,
                    //                         managerNameLV1 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH
                    //                     };

                    //var ManagerNameLV2 = from m in JAManagerFlowApproves
                    //                     join e in employees on m.mangerEmpID equals e.EmpID into table1
                    //                     from e in table1.ToList()
                    //                     join lv1 in ManagerNameLV1 on m.id equals lv1.mid into table2
                    //                     from lv1 in table2.ToList()
                    //                     join lv0 in ManagerNameLV0 on m.id equals lv0.mid into table3
                    //                     from lv0 in table3.ToList()
                    //                     select new
                    //                     {
                    //                         _mid = m.id,
                    //                         _managerEmpID = m.mangerEmpID,
                    //                         _managerNameLV2 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,

                    //                         _managerLV1ID = lv1.managerLV1ID,
                    //                         _managerNameLV1 = lv1.managerNameLV1,

                    //                         _managerLV0ID = lv0.managerLV0ID,
                    //                         _managerNameLV0 = lv0.managerNameLV0,
                    //                     };

                    //var JaForManager = from e in employees
                    //                     join jde in jdMasterEmp on e.EmpID equals jde.empId into table1
                    //                     from jde in table1.ToList()
                    //                     join jd in jdMaster on jde.jdId equals jd.id into table2
                    //                     from jd in table2.ToList()
                    //                     join ja in jaMaster on jde.jdId equals ja.masterEmpId into table3
                    //                     from ja in table3.ToList()
                    //                     join ma in ManagerNameLV2 on e.DirectorID equals ma._mid into table4
                    //                     from ma in table4.ToList()
                    //                   select new
                    //                     {
                    //                         JaID = ja.id,
                    //                         JdID = jd.id,
                    //                         JdIDEmp = jde.id,
                    //                         _EmpID = e.EmpID,
                    //                         _SLRI_ID = e.SLRI_ID,
                    //                         _CardID = e.CardID,
                    //                         _Orders = e.Orders,
                    //                         fullName = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
                    //                         _EmployeeLevelID = e.EmployeeLevelID,
                    //                         _EmployeeLevel = e.EmployeeLevel,
                    //                         _DepID = e.DepID,
                    //                         _Department = e.Department,
                    //                         _SectorID = e.SectorID,
                    //                         _Sector = e.Sector,
                    //                         _Position = e.Position,
                    //                         _DirectorID = e.DirectorID,
                    //                         mid = ma._mid,
                    //                         mangerEmpID = ma._managerEmpID,
                    //                         ManagerNameLV2 = ma._managerNameLV2,
                    //                         mangerLV1ID = ma._managerLV1ID,
                    //                         ManagerNameLV1 = ma._managerNameLV1,
                    //                         mangerLV0ID = ma._managerLV0ID,
                    //                         ManagerNameLV0 = ma._managerNameLV0,
                    //                         _jdPosition = jd.jdPosition,
                    //                         _jdDepartment = jd.jdDepartment,
                    //                         _jaYear = ja.jaYear
                    //                     };

                    //var JaForManager = from e in employees
                    //                   join ma in JAManagerFlowApproves on e.DirectorID equals ma.id into table1
                    //                   from ma in table1.ToList()
                    //                   join jde in jdMasterEmp on e.EmpID equals jde.empId into table2
                    //                   from jde in table2.ToList()
                    //                   join jd in jdMaster on jde.jdId equals jd.id into table3
                    //                   from jd in table3.ToList()
                    //                   join ja in jaMaster on jde.id equals ja.masterEmpId into table4
                    //                   from ja in table4.ToList()
                    //                   where ma.mangerEmpID == Session["EmpID"].ToString()
                    //                   where jde.isActive == "A"
                    //                   select new ForManager
                    //                   {
                    //                       employees = e,
                    //                       JAManagerFlowApproves = ma,
                    //                       jdMasterEmp = jde,
                    //                       jdMaster = jd,
                    //                       jaMaster = ja,

                    //                   };

                    string EmpId = Session["EmpID"].ToString();

                    var JaForManager = db.View_ManagerViewJADetail.Where(a => a.mangerEmpID.Equals(EmpId) || a.mangerLV0ID.Equals(EmpId) || a.mangerLV1ID.Equals(EmpId)).ToList();

                    //var JaForManager = db.View_ManagerViewJADetail.ToList();

                    ViewBag.CurrentSort = sortOrder;
                    ViewBag.jaIDSortParm = String.IsNullOrEmpty(sortOrder) ? "id_desc" : "";
                    ViewBag.fullNameSortParm = String.IsNullOrEmpty(sortOrder) ? "fullName_desc" : "";
                    ViewBag.jaYearSortParm = String.IsNullOrEmpty(sortOrder) ? "jaYear_desc" : "";
                    ViewBag.StatusSortParm = String.IsNullOrEmpty(sortOrder) ? "jaStatus_desc" : "";

                    if (SearchStringName != null)
                    {
                        page = 1;
                    }
                    else
                    {
                        SearchStringName = currentFilter;
                    }

                    ViewBag.CurrentFilter = SearchStringName;

                    var JaForManagerList = from s in JaForManager
                                   select s;



                    //if (!String.IsNullOrEmpty(SearchStringName) && !String.IsNullOrEmpty(SearchStringYear))
                    //{
                    //    JaForManagerList = JaForManagerList.Where(s => s.jaMaster.fullname.Contains(SearchStringName) && s.jaMaster.jaYear.Contains(SearchStringYear));

                    //}
                    //else if (!String.IsNullOrEmpty(SearchStringName) && (!String.IsNullOrEmpty(SearchStringStatus) && SearchStringStatus != "selected"))
                    //{
                    //    JaForManagerList = JaForManagerList.Where(s => s.jaMaster.fullname.Contains(SearchStringName) && s.jaMaster.jaStatus.Contains(SearchStringStatus));

                    //}
                    //else if (!String.IsNullOrEmpty(SearchStringYear) && (!String.IsNullOrEmpty(SearchStringStatus) && SearchStringStatus != "selected"))
                    //{
                    //    JaForManagerList = JaForManagerList.Where(s => s.jaMaster.jaYear.Contains(SearchStringYear) && s.jaMaster.jaStatus.Contains(SearchStringStatus));
                    //}
                    //else if (!String.IsNullOrEmpty(SearchStringName) && !String.IsNullOrEmpty(SearchStringYear) && (!String.IsNullOrEmpty(SearchStringStatus) && SearchStringStatus != "selected"))
                    //{
                    //    JaForManagerList = JaForManagerList.Where(s => s.jaMaster.fullname.Contains(SearchStringName)
                    //                            && s.jaMaster.jaYear.Contains(SearchStringYear)
                    //                            && s.jaMaster.jaStatus.Contains(SearchStringStatus));
                    //}
                    //else if (!String.IsNullOrEmpty(SearchStringName))
                    //{
                    //    JaForManagerList = JaForManagerList.Where(s => s.jaMaster.fullname.Contains(SearchStringName));
                    //}

                    //else if (!String.IsNullOrEmpty(SearchStringYear))
                    //{
                    //    JaForManagerList = JaForManagerList.Where(s => s.jaMaster.jaYear.Contains(SearchStringYear));
                    //}

                    //else if (!String.IsNullOrEmpty(SearchStringStatus) && SearchStringStatus != "selected")
                    //{
                    //    JaForManagerList = JaForManagerList.Where(s => s.jaMaster.jaStatus.Contains(SearchStringStatus));
                    //}


                    //switch (sortOrder)
                    //{
                    //    case "id_desc":
                    //        JaForManagerList = JaForManagerList.OrderByDescending(s => s.jaMaster.id);
                    //        break;
                    //    case "fullName_desc":
                    //        JaForManagerList = JaForManagerList.OrderByDescending(s => s.jaMaster.fullname);
                    //        break;
                    //    case "jaYear_desc":
                    //        JaForManagerList = JaForManagerList.OrderByDescending(s => s.jaMaster.jaYear);
                    //        break;
                    //    case "jaStatus_desc":
                    //        JaForManagerList = JaForManagerList.OrderByDescending(s => s.jaMaster.jaStatus);
                    //        break;
                    //    default:  // Name ascending 
                    //        JaForManagerList = JaForManagerList.OrderByDescending(s => s.jaMaster.id);
                    //        break;
                    //}

                    if (!String.IsNullOrEmpty(SearchStringName) && !String.IsNullOrEmpty(SearchStringYear))
                    {
                        JaForManagerList = JaForManagerList.Where(s => s.fullname.Contains(SearchStringName) && s.jaYear.Contains(SearchStringYear));

                    }
                    else if (!String.IsNullOrEmpty(SearchStringName) && (!String.IsNullOrEmpty(SearchStringStatus) && SearchStringStatus != "selected"))
                    {
                        JaForManagerList = JaForManagerList.Where(s => s.fullname.Contains(SearchStringName) && s.jaStatus.Contains(SearchStringStatus));

                    }
                    else if (!String.IsNullOrEmpty(SearchStringYear) && (!String.IsNullOrEmpty(SearchStringStatus) && SearchStringStatus != "selected"))
                    {
                        JaForManagerList = JaForManagerList.Where(s => s.jaYear.Contains(SearchStringYear) && s.jaStatus.Contains(SearchStringStatus));
                    }
                    else if (!String.IsNullOrEmpty(SearchStringName) && !String.IsNullOrEmpty(SearchStringYear) && (!String.IsNullOrEmpty(SearchStringStatus) && SearchStringStatus != "selected"))
                    {
                        JaForManagerList = JaForManagerList.Where(s => s.fullname.Contains(SearchStringName)
                                                && s.jaYear.Contains(SearchStringYear)
                                                && s.jaStatus.Contains(SearchStringStatus));
                    }
                    else if (!String.IsNullOrEmpty(SearchStringName))
                    {
                        JaForManagerList = JaForManagerList.Where(s => s.fullname.Contains(SearchStringName));
                    }

                    else if (!String.IsNullOrEmpty(SearchStringYear))
                    {
                        JaForManagerList = JaForManagerList.Where(s => s.jaYear.Contains(SearchStringYear));
                    }

                    else if (!String.IsNullOrEmpty(SearchStringStatus) && SearchStringStatus != "selected")
                    {
                        JaForManagerList = JaForManagerList.Where(s => s.jaStatus.Contains(SearchStringStatus));
                    }


                    switch (sortOrder)
                    {
                        case "id_desc":
                            JaForManagerList = JaForManagerList.OrderByDescending(s => s.id);
                            break;
                        case "fullName_desc":
                            JaForManagerList = JaForManagerList.OrderByDescending(s => s.fullname);
                            break;
                        case "jaYear_desc":
                            JaForManagerList = JaForManagerList.OrderByDescending(s => s.jaYear);
                            break;
                        case "jaStatus_desc":
                            JaForManagerList = JaForManagerList.OrderByDescending(s => s.jaStatus);
                            break;
                        default:  // Name ascending 
                            JaForManagerList = JaForManagerList.OrderByDescending(s => s.id);
                            break;
                    }

                    int pageSize = 3;
                    int pageNumber = (page ?? 1);
                    return View(JaForManagerList);
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult ConsiderJAForManager(int id, FormCollection fc)
        {
            if (Session["EmpID"] != null)
            {
                var Edit = db.JAMasters.Where(a => a.id == id).Single();
                string jaStatusCheck = fc["consider"];
                string jaStatus;
                if (jaStatusCheck == "yes")
                {
                    jaStatus = "Approved";
                }
                else
                {
                    jaStatus = "Draft";
                }
                try
                {
                    Edit.jaStatus = jaStatus;
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }
                return RedirectToAction("JaHeadSearch");
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }


        public ActionResult JAForManagerCommentView(int id, int jaId, string type)
        {
            using (HRISEntities db = new HRISEntities())
            {
                List<Employee> employees = db.Employees.ToList();
                List<JAManagerFlowApprove> JAManagerFlowApproves = db.JAManagerFlowApproves.ToList();

                if (type == "K")
                {
                    List<JAMasterKeyResponsibilitiesDetail> KEYs = db.JAMasterKeyResponsibilitiesDetails.ToList();
                    var JAMasterKeyResponsibilitiesDetail = from e in employees
                                                            join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                            from d in table1.ToList()
                                                            join k in KEYs on d.id equals k.directorId into table2
                                                            from k in table2.ToList()
                                                            select new JoinKey
                                                            {
                                                                Key = k,
                                                                employees = e,
                                                                JAManagerFlowApproves = d
                                                            };

                    ViewBag.JaDetails = db.View_ManagerViewJADetail.Where(a => a.id == jaId).Single();
                    ViewBag.History = db.JAComments.Where(a => a.refId == id).OrderByDescending(a => a.createdDate).ToList();
                    ViewBag.Details = JAMasterKeyResponsibilitiesDetail.Where(a => a.Key.id == id).Single();
                    ViewBag.Type = type;

                }
                else if (type == "S")
                {
                    List<JAMasterSecondaryActivitiesDetail> SECs = db.JAMasterSecondaryActivitiesDetails.ToList();
                    var JAMasterSecondaryActivitiesDetail = from e in employees
                                                            join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                            from d in table1.ToList()
                                                            join k in SECs on d.id equals k.directorId into table2
                                                            from k in table2.ToList()
                                                            select new JoinSec
                                                            {
                                                                Sec = k,
                                                                employees = e,
                                                                JAManagerFlowApproves = d
                                                            };

                    ViewBag.JaDetails = db.View_ManagerViewJADetail.Where(a => a.id == jaId).Single();
                    ViewBag.History = db.JAComments.Where(a => a.refId == id).OrderByDescending(a => a.createdDate).ToList();
                    ViewBag.Details = JAMasterSecondaryActivitiesDetail.Where(a => a.Sec.id == id).Single();
                    ViewBag.Type = type;


                }
                else if (type == "O")
                {
                    List<JAMasterOtherActivitiesDetail> OTHERs = db.JAMasterOtherActivitiesDetails.ToList();
                    var JAMasterOtherActivitiesDetail = from e in employees
                                                        join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                        from d in table1.ToList()
                                                        join k in OTHERs on d.id equals k.directorId into table2
                                                        from k in table2.ToList()
                                                        select new JoinOther
                                                        {
                                                            Other = k,
                                                            employees = e,
                                                            JAManagerFlowApproves = d
                                                        };


                    ViewBag.JaDetails = db.View_ManagerViewJADetail.Where(a => a.id == jaId).Single();
                    ViewBag.History = db.JAComments.Where(a => a.refId == id).OrderByDescending(a => a.createdDate).ToList();
                    ViewBag.Details = JAMasterOtherActivitiesDetail.Where(a => a.Other.id == id).Single();
                    ViewBag.Type = type;

                }
                else if (type == "E")
                {
                    List<JAMasterExtraDetail> EXTRAs = db.JAMasterExtraDetails.ToList();
                    var JAMasterExtraDetail = from e in employees
                                              join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                              from d in table1.ToList()
                                              join k in EXTRAs on d.id equals k.directorId into table2
                                              from k in table2.ToList()
                                              select new JoinExtra
                                              {
                                                  Extra = k,
                                                  employees = e,
                                                  JAManagerFlowApproves = d
                                              };


                    ViewBag.JaDetails = db.View_ManagerViewJADetail.Where(a => a.id == jaId).Single();
                    ViewBag.History = db.JAComments.Where(a => a.refId == id).OrderByDescending(a => a.createdDate).ToList();
                    ViewBag.Details = JAMasterExtraDetail.Where(a => a.Extra.id == id).Single();
                    ViewBag.Type = type;
                }
                else
                {

                }

                return View();
            }

        }

        public ActionResult JAForManagerComment(int id, int jaId, string type, string EmpId, FormCollection fc)
        {
            using (HRISEntities db = new HRISEntities())
            { 
                try
                    {

                        JAComment jc = new JAComment();
                        jc.commentDetails = fc["taCommentDetails"];
                        jc.commentType = type;
                        jc.commentStatus = "A";
                        jc.refId = id;
                        jc.createdDate = DateTime.Now;
                        db.JAComments.Add(jc);
                        db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }
            }
            return RedirectToAction("JAForManager" , new { jdId = jaId, EmpID = EmpId });
        }

        public ActionResult JAForManager(int jdId, string EmpID)
        {
            if (Session["EmpID"] != null)
            {
                using (HRISEntities db = new HRISEntities())
                {
                    List<Employee> employees = db.Employees.ToList();
                    List<JDMasterEmp> jdMasterEmp = db.JDMasterEmps.ToList();
                    List<JDMaster> jdMaster = db.JDMasters.ToList();
                    List<JAMaster> jaMaster = db.JAMasters.ToList();
                    List<JAManagerFlowApprove> JAManagerFlowApproves = db.JAManagerFlowApproves.ToList();

                    var JAMasterEmpDetails = from e in employees
                                             join d in jdMasterEmp on e.EmpID equals d.empId into table1
                                             from d in table1.ToList()
                                             join i in jdMaster on d.jdId equals i.id into table2
                                             from i in table2.ToList()
                                             where e.EmpID == EmpID
                                             where d.jdId == jdId  //UserID session
                                             select new ViewModel
                                             {
                                                 employees = e,
                                                 jdMasterEmp = d,
                                                 jdMaster = i
                                             };

                    List<JAMasterKPIDetail> KPIs = db.JAMasterKPIDetails.ToList();
                    var JAMasterKPIDetail = from e in employees
                                            join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                            from d in table1.ToList()
                                            join k in KPIs on d.id equals k.directorId into table2
                                            from k in table2.ToList()
                                            select new JoinKpi
                                            {
                                                Kpi = k,
                                                employees = e,
                                                JAManagerFlowApproves = d
                                            };

                    List<JAMasterKeyResponsibilitiesDetail> KEYs = db.JAMasterKeyResponsibilitiesDetails.ToList();
                    var JAMasterKeyResponsibilitiesDetail = from e in employees
                                                            join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                            from d in table1.ToList()
                                                            join k in KEYs on d.id equals k.directorId into table2
                                                            from k in table2.ToList()
                                                            select new JoinKey
                                                            {
                                                                Key = k,
                                                                employees = e,
                                                                JAManagerFlowApproves = d
                                                            };

                    List<JAMasterSecondaryActivitiesDetail> SECs = db.JAMasterSecondaryActivitiesDetails.ToList();
                    var JAMasterSecondaryActivitiesDetail = from e in employees
                                                            join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                            from d in table1.ToList()
                                                            join k in SECs on d.id equals k.directorId into table2
                                                            from k in table2.ToList()
                                                            select new JoinSec
                                                            {
                                                                Sec = k,
                                                                employees = e,
                                                                JAManagerFlowApproves = d
                                                            };

                    List<JAMasterOtherActivitiesDetail> OTHERs = db.JAMasterOtherActivitiesDetails.ToList();
                    var JAMasterOtherActivitiesDetail = from e in employees
                                                        join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                        from d in table1.ToList()
                                                        join k in OTHERs on d.id equals k.directorId into table2
                                                        from k in table2.ToList()
                                                        select new JoinOther
                                                        {
                                                            Other = k,
                                                            employees = e,
                                                            JAManagerFlowApproves = d
                                                        };

                    List<JAMasterExtraDetail> EXTRAs = db.JAMasterExtraDetails.ToList();
                    var JAMasterExtraDetail = from e in employees
                                              join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                              from d in table1.ToList()
                                              join k in EXTRAs on d.id equals k.directorId into table2
                                              from k in table2.ToList()
                                              select new JoinExtra
                                              {
                                                  Extra = k,
                                                  employees = e,
                                                  JAManagerFlowApproves = d
                                              };

                    var managerName = from e in employees
                                      join d in JAManagerFlowApproves on e.DirectorID equals d.id into table1
                                      from d in table1.ToList()
                                      where e.EmpID == EmpID
                                      select new JaManager
                                      {
                                          employees = e,
                                          JAManagerFlowApproves = d
                                      };


                    var jd = JAMasterEmpDetails.Single();
                    var ja = db.JAMasters.Where(a => a.masterEmpId == jd.jdMasterEmp.id).Single();
                    ViewData["jaDetails"] = ja;
                    var mangerNameId = managerName.Single();

                    //--------------------------------------------------หัวหน้าตามสายงาน-------------------------------------------------------------
                    //var DirectorSectionInWorkTable = (from s1 in db.JAMasterKPIDetails where s1.isStatus == "A" && s1.jaMasterId == ja.id
                    //                                  select new 
                    //                       {
                    //                           directorID = s1.directorId
                    //                       }).Distinct().ToList()
                    //                       .Union(from s2 in db.JAMasterKeyResponsibilitiesDetails where s2.isStatus == "A" && s2.jaMasterId == ja.id
                    //                              select new
                    //                       {
                    //                           directorID = s2.directorId
                    //                       }).Distinct().ToList()
                    //                       .Union(from s3 in db.JAMasterSecondaryActivitiesDetails where s3.isStatus == "A" && s3.jaMasterId == ja.id
                    //                              select new
                    //                       {
                    //                           directorID = s3.directorId
                    //                       }).Distinct().ToList()
                    //                       .Union(from s4 in db.JAMasterOtherActivitiesDetails where s4.isStatus == "A" && s4.jaMasterId == ja.id
                    //                              select new
                    //                       {
                    //                           directorID = s4.directorId
                    //                       }).Distinct().ToList() 
                    //                       .Union(from s5 in db.JAMasterExtraDetails where s5.isStatus == "A" && s5.jaMasterId == ja.id
                    //                              select new 
                    //                       {
                    //                           directorID = s5.directorId
                    //                       }).Distinct().ToList();

                    //var DirectorSection = from d in JAManagerFlowApproves
                    //                  join k in DirectorSectionInWorkTable on d.id equals k.directorID into table1
                    //                  from k in table1.ToList()
                    //                  join e in employees on d.mangerEmpID equals e.EmpID into table2
                    //                  from e in table2.ToList()
                    //                  select new JaManager
                    //                  {
                    //                      employees = e,
                    //                      JAManagerFlowApproves = d
                    //                  };
                    //--------------------------------------------------หัวหน้าตามสายงาน-------------------------------------------------------------

                    var checklv1 = db.View_ManagerViewJADetail.Where(a => a.empId == EmpID).Single();

                    if (checklv1.mangerLV1ID == null)
                    {
                        Session["Checklv1"] = "0";
                        var ManagerNameLV0 = from m in JAManagerFlowApproves
                                             join e in employees on m.mangerLV0ID equals e.EmpID
                                             select new
                                             {
                                                 mid = m.id,
                                                 managerLV0ID = m.mangerLV0ID,
                                                 managerNameLV0 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
                                                 Position = e.Position
                                             };


                        var ManagerNameLV2 = from m in JAManagerFlowApproves
                                             join e in employees on m.mangerEmpID equals e.EmpID into table1
                                             from e in table1.ToList()
                                             join lv0 in ManagerNameLV0 on m.id equals lv0.mid into table3
                                             from lv0 in table3.ToList()
                                             where m.id == jd.employees.DirectorID
                                             select new
                                             {
                                                 _mid = m.id,
                                                 _managerLV2ID = m.mangerEmpID,
                                                 _managerNameLV2 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
                                                 _managerLV2Position = e.Position,

                                                 _managerLV0ID = lv0.managerLV0ID,
                                                 _managerNameLV0 = lv0.managerNameLV0,
                                                 _managerLV0Position = lv0.Position
                                             };

                        var Mn = ManagerNameLV2.Single();


                        ViewBag._managerNameLV2 = Mn._managerNameLV2;
                        ViewBag._managerLV2Position = Mn._managerLV2Position;



                        ViewBag._managerNameLV0 = Mn._managerNameLV0;
                        ViewBag._managerLV0Position = Mn._managerLV0Position;
                    }
                    else
                    {
                        Session["Checklv1"] = "1";
                        var ManagerNameLV0 = from m in JAManagerFlowApproves
                                             join e in employees on m.mangerLV0ID equals e.EmpID
                                             select new
                                             {
                                                 mid = m.id,
                                                 managerLV0ID = m.mangerLV0ID,
                                                 managerNameLV0 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
                                                 Position = e.Position
                                             };

                        var ManagerNameLV1 = from m in JAManagerFlowApproves
                                             join e in employees on m.mangerLV1ID equals e.EmpID
                                             select new
                                             {
                                                 mid = m.id,
                                                 managerLV1ID = m.mangerLV1ID,
                                                 managerNameLV1 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
                                                 Position = e.Position
                                             };



                        var ManagerNameLV2 = from m in JAManagerFlowApproves
                                             join e in employees on m.mangerEmpID equals e.EmpID into table1
                                             from e in table1.ToList()
                                             join lv1 in ManagerNameLV1 on m.id equals lv1.mid into table2
                                             from lv1 in table2.ToList()
                                             join lv0 in ManagerNameLV0 on m.id equals lv0.mid into table3
                                             from lv0 in table3.ToList()
                                             where m.id == jd.employees.DirectorID
                                             select new
                                             {
                                                 _mid = m.id,
                                                 _managerLV2ID = m.mangerEmpID,
                                                 _managerNameLV2 = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
                                                 _managerLV2Position = e.Position,

                                                 _managerLV1ID = lv1.managerLV1ID,
                                                 _managerNameLV1 = lv1.managerNameLV1,
                                                 _managerLV1Position = lv1.Position,

                                                 _managerLV0ID = lv0.managerLV0ID,
                                                 _managerNameLV0 = lv0.managerNameLV0,
                                                 _managerLV0Position = lv0.Position
                                             };

                        var Mn = ManagerNameLV2.Single();

       
                        ViewBag._managerNameLV2 = Mn._managerNameLV2;
                        ViewBag._managerLV2Position = Mn._managerLV2Position;

                        ViewBag._managerNameLV1 = Mn._managerNameLV1;
                        ViewBag._managerLV1Position = Mn._managerLV1Position;

                        ViewBag._managerNameLV0 = Mn._managerNameLV0;
                        ViewBag._managerLV0Position = Mn._managerLV0Position;
                    }
                    //ViewBag.NameDirector2 = db.Employees.Where(a => a.EmpID == mangerNameId.JAManagerFlowApproves.mangerEmpID && ).Single(); หัวหน้าส่วน
                    ViewBag.listKpi = JAMasterKPIDetail.Where(a => a.Kpi.isStatus == "A" && a.Kpi.jaMasterId == ja.id).ToList();
                    ViewBag.listKey = JAMasterKeyResponsibilitiesDetail.Where(a => a.Key.isStatus == "A" && a.Key.jaMasterId == ja.id).OrderBy(a => a.Key.levelDisplay).ThenBy(a => a.Key.id).ToList();
                    ViewBag.listSecondKey = JAMasterSecondaryActivitiesDetail.Where(a => a.Sec.isStatus == "A" && a.Sec.jaMasterId == ja.id).ToList();
                    ViewBag.listOtherKey = JAMasterOtherActivitiesDetail.Where(a => a.Other.isStatus == "A" && a.Other.jaMasterId == ja.id).ToList();
                    ViewBag.listExtraKey = JAMasterExtraDetail.Where(a => a.Extra.isStatus == "A" && a.Extra.jaMasterId == ja.id).ToList();
                    return View();
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult exportReport()
        {
            using (HRISEntities db = new HRISEntities())
            {
                List<Employee> employees = db.Employees.ToList();
                List<JDMasterEmp> jdMasterEmp = db.JDMasterEmps.ToList();
                List<JDMaster> jdMaster = db.JDMasters.ToList();
                List<JAMaster> jaMaster = db.JAMasters.ToList();
                List<JAManagerFlowApprove> JAManagerFlowApproves = db.JAManagerFlowApproves.ToList();

                var managerName = from e in employees
                                  join d in JAManagerFlowApproves on e.DirectorID equals d.id into table1
                                  from d in table1.ToList()
                                  select new 
                                  {
                                      _id = d.id,
                                      FullNameManager = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
                                      managerEmpID = d.mangerEmpID,
                                      _Position = e.Position
                                  };

                //var jaMasterDetails = from e in employees
                //                      join d in JAManagerFlowApproves on e.DirectorID equals d.id into table1
                //                      from d in table1.ToList()
                //                      join  in jdMasterEmp on e.DirectorID equals d.id into table1
                //                      from d in table1.ToList()
                //                      select new
                //                      {
                //                          _id = d.id,
                //                          FullNameManager = e.TitleTH + e.FirstNameTH + " " + e.LastNameTH,
                //                          managerEmpID = d.mangerEmpID,
                //                          _Position = e.Position
                //                      };

                ReportDocument rd = new ReportDocument();
                var c = (from e in db.Employees select new { e.FirstNameTH }).ToList();
                rd.Load(Path.Combine(Server.MapPath("~/Report"), "JobAgreementReport.rpt"));
                rd.SetDataSource(c);
                //rd.Subreports[0].
                Response.Buffer = false;
                Response.ClearContent();
                Response.ClearHeaders();
                try
                {
                    Stream stream = rd.ExportToStream(CrystalDecisions.Shared.ExportFormatType.PortableDocFormat);
                    stream.Seek(0, SeekOrigin.Begin);
                    return File(stream, "application/pdf", "Employee_list.pdf");
                }
                catch
                {
                    throw;
                }

     
            }

        }

        public ActionResult JaSearch(string sortOrder, string currentFilter, string SearchStringYear, string SearchStringStatus, int? page)
        {
            if (Session["EmpID"] != null)
            {
                using (HRISEntities db = new HRISEntities())
                {
                    List<Employee> employees = db.Employees.ToList();
                    List<JDMasterEmp> jdMasterEmp = db.JDMasterEmps.ToList();
                    List<JDMaster> jdMaster = db.JDMasters.ToList();
                    List<JAMaster> jaMaster = db.JAMasters.ToList();

                    var JaSearchDetails = from e in employees
                                          join d in jdMasterEmp on e.EmpID equals d.empId into table1
                                          from d in table1.ToList()
                                          join i in jdMaster on d.jdId equals i.id into table2
                                          from i in table2.ToList()
                                          join j in jaMaster on d.id equals j.masterEmpId into table3
                                          from j in table3.ToList()
                                          where e.EmpID == Session["EmpID"].ToString()
                                          where d.isActive == "A"  //UserID session
                                          select new ViewModel
                                          {
                                              employees = e,
                                              jdMasterEmp = d,
                                              jdMaster = i,
                                              jaMaster = j
                                          };


                    ViewBag.CurrentSort = sortOrder;
                    ViewBag.jaYearSortParm = String.IsNullOrEmpty(sortOrder) ? "jaYear_desc" : "";
                    ViewBag.StatusSortParm = String.IsNullOrEmpty(sortOrder) ? "jaStatus_desc" : "";

                    if (SearchStringYear != null)
                    {
                        page = 1;
                    }
                    else
                    {
                        SearchStringYear = currentFilter;
                    }

                    ViewBag.CurrentFilter = SearchStringYear;

                    var jaMasterSearch = from s in JaSearchDetails
                                          select s;



                    if (!String.IsNullOrEmpty(SearchStringYear) && !String.IsNullOrEmpty(SearchStringStatus) && SearchStringStatus != "selected" && SearchStringYear != "selected")
                    {
                        jaMasterSearch = jaMasterSearch.Where(s => s.jaMaster.jaYear.Contains(SearchStringYear) && s.jaMaster.jaStatus.Contains(SearchStringStatus));
                    }
                    else if (!String.IsNullOrEmpty(SearchStringYear) && SearchStringStatus != "selected" && SearchStringYear != "selected")
                    {
                        jaMasterSearch = jaMasterSearch.Where(s => s.jaMaster.jaYear.Contains(SearchStringYear));
                    }                                      
                    else if (!String.IsNullOrEmpty(SearchStringStatus) && SearchStringStatus != "selected")
                    {
                        jaMasterSearch = jaMasterSearch.Where(s => s.jaMaster.jaStatus.Contains(SearchStringStatus));
                    }



                    switch (sortOrder)
                    {
                        case "jaYear_desc":
                            jaMasterSearch = jaMasterSearch.OrderByDescending(s => s.jaMaster.jaYear);
                            break;
                        case "jaStatus_desc":
                            jaMasterSearch = jaMasterSearch.OrderByDescending(s => s.jaMaster.jaStatus);
                            break;
                        default:  // Name ascending 
                            jaMasterSearch = jaMasterSearch.OrderByDescending(s => s.jaMaster.id);
                            break;
                    }



                    ViewBag.jaSearchDetails = JaSearchDetails.First();
                    int pageSize = 3;
                    int pageNumber = (page ?? 1);
                    return View(jaMasterSearch.ToPagedList(pageNumber, pageSize));
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult CheckYearOpen()
        {
            ViewBag.yearOpen = db.JAControls.Where(a => a.jaStatus == "O").Single();

            return ViewBag.yearOpen;
        }

        public ActionResult CreateJA()
        {
            if (Session["EmpID"] != null)
            {
                JAMaster ja = new JAMaster();
                JAMasterKeyResponsibilitiesDetail jaKey = new JAMasterKeyResponsibilitiesDetail();
                //Session id user
                string i = Session["EmpID"].ToString();
                int jdId = int.Parse(Session["jdId"].ToString());
                //Check jaControl
                var jaControls = db.JAControls.Where(a => a.jaStatus == "O").Single();
                string yearOpen = jaControls.jaYear;

                //Chack User JDMasterEmp
                var jdMasterEmps = db.JDMasterEmps.Where(a => a.empId == i && a.jdId == jdId).Single();
                int jdMasterId = jdMasterEmps.id;

                //Check JAMaster (have or donthave)
                int JAMaster = db.JAMasters.Where(a => a.jaYear == yearOpen && a.masterEmpId == jdMasterId).Count();
                var jd = db.JDMasters.Where(a => a.id == jdId).Single();
                if (JAMaster == 0)
                {
                    try
                    {
                        //Select Employees Detail
                        var emp = db.Employees.Where(a => a.EmpID == i).Single();

                        ja.jaYear = yearOpen;
                        ja.masterEmpId = jdMasterId;
                        ja.fullname = emp.TitleTH + emp.FirstNameTH + " " + emp.LastNameTH;
                        ja.JobPurpose = jd.jdPurpose;
                        ja.empPosition = emp.Position;
                        ja.empSection = emp.Sector;
                        ja.empDepartment = emp.Department;
                        ja.keyResponsibilitiesWeight = jd.keyResponsibilitiesWeight;
                        ja.secondaryActivitiesWeight = jd.secondaryActivitiesWeight;
                        ja.otherActivitiesWeight = jd.otherActivitiesWeight;
                        ja.jaStatus = "Draft";
                        ja.createdDate = DateTime.Now;
                        ja.JACreatedDate = DateTime.Now;
                        db.JAMasters.Add(ja);
                        db.SaveChanges();
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

                }
                else
                {

                }

                //Check SELECT JAMaster for use id
                var JAMaster2 = db.JAMasters.Where(a => a.jaYear == yearOpen && a.masterEmpId == jdMasterId).Single();
                int JAMaster2Id = JAMaster2.id;
                int ii = 1;
                int iii = 1;
                if (JAMaster == 0)
                {
                    try
                    {
                        //Select Employees Detail
                        var emp = db.Employees.Where(a => a.EmpID == i).Single();
                        var jdSub = db.JDMasterSubs.Where(a => a.jdMasterId == jdMasterEmps.jdId).ToList();

                        foreach (JDMasterSub k in jdSub.ToList())
                        {
                            jaKey.jaMasterId = JAMaster2Id;
                            jaKey.subKeyId = k.id; //k.id;
                            jaKey.weight = k.weight;
                            jaKey.addSubCheck = "K";
                            jaKey.idRefSub = ii++;
                            jaKey.levelDisplay = iii++;
                            jaKey.descriptionKey = k.descriptionSub;
                            jaKey.directorId = emp.DirectorID;
                            jaKey.isStatus = k.isStatus;
                            jaKey.createdDate = DateTime.Now;
                            db.JAMasterKeyResponsibilitiesDetails.Add(jaKey);
                            db.SaveChanges();
                        }
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
                }
                else
                {

                }

                using (HRISEntities db = new HRISEntities())
                {

                    List<Employee> employees = db.Employees.ToList();
                    List<JAManagerFlowApprove> JAManagerFlowApproves = db.JAManagerFlowApproves.ToList();

                    var checkHeadKey = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.jaMasterId == JAMaster2Id && a.isStatus == "A" && a.addSubCheck == "K").ToList();

                    foreach (var ks in checkHeadKey)
                    {
                        decimal? sumSubKey = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.idRefSub == ks.id && a.isStatus == "A" && a.addSubCheck == null).Sum(b => b.weight);

                        try
                        {
                            JAMasterKeyResponsibilitiesDetail listKey = new JAMasterKeyResponsibilitiesDetail();
                            listKey = db.JAMasterKeyResponsibilitiesDetails.Find(ks.id);
                            listKey.sumSubKey = sumSubKey;

                            db.Entry(listKey).State = EntityState.Modified;
                            db.SaveChanges();
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
                                    raise = new InvalidOperationException(message, raise);
                                }
                            }
                            throw raise;
                        }

                    }

                    List<JAMasterKPIDetail> KPIs = db.JAMasterKPIDetails.ToList();
                    var JAMasterKPIDetail = from e in employees
                                            join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                            from d in table1.ToList()
                                            join k in KPIs on d.id equals k.directorId into table2
                                            from k in table2.ToList()
                                            select new JoinKpi
                                            {
                                                Kpi = k,
                                                employees = e,
                                                JAManagerFlowApproves = d
                                            };

                    List<JAMasterKeyResponsibilitiesDetail> KEYs = db.JAMasterKeyResponsibilitiesDetails.ToList();
                    var JAMasterKeyResponsibilitiesDetail = from e in employees
                                                            join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                            from d in table1.ToList()
                                                            join k in KEYs on d.id equals k.directorId into table2
                                                            from k in table2.ToList()
                                                            select new JoinKey
                                                            {
                                                                Key = k,
                                                                employees = e,
                                                                JAManagerFlowApproves = d
                                                            };

                    List<JAMasterSecondaryActivitiesDetail> SECs = db.JAMasterSecondaryActivitiesDetails.ToList();
                    var JAMasterSecondaryActivitiesDetail = from e in employees
                                                            join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                            from d in table1.ToList()
                                                            join k in SECs on d.id equals k.directorId into table2
                                                            from k in table2.ToList()
                                                            select new JoinSec
                                                            {
                                                                Sec = k,
                                                                employees = e,
                                                                JAManagerFlowApproves = d
                                                            };

                    List<JAMasterOtherActivitiesDetail> OTHERs = db.JAMasterOtherActivitiesDetails.ToList();
                    var JAMasterOtherActivitiesDetail = from e in employees
                                                        join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                                        from d in table1.ToList()
                                                        join k in OTHERs on d.id equals k.directorId into table2
                                                        from k in table2.ToList()
                                                        select new JoinOther
                                                        {
                                                            Other = k,
                                                            employees = e,
                                                            JAManagerFlowApproves = d
                                                        };

                    List<JAMasterExtraDetail> EXTRAs = db.JAMasterExtraDetails.ToList();
                    var JAMasterExtraDetail = from e in employees
                                              join d in JAManagerFlowApproves on e.EmpID equals d.mangerEmpID into table1
                                              from d in table1.ToList()
                                              join k in EXTRAs on d.id equals k.directorId into table2
                                              from k in table2.ToList()
                                              select new JoinExtra
                                              {
                                                  Extra = k,
                                                  employees = e,
                                                  JAManagerFlowApproves = d
                                              };

                    

                    ViewBag.txtWeightKpi = "0";
                    ViewData["jaDetails"] = db.JAMasters.Where(a => a.id == JAMaster2Id).Single();
                    var jaDetails = db.JAMasters.Where(a => a.id == JAMaster2Id).Single();

                    if(Session["CheckSesWeight"].ToString() == "1")
                    {
                        if(jaDetails.KPIWeight != null)
                        {
                            Session["txtWeightKpi"] = jaDetails.KPIWeight;
                        }
                        else
                        {
                            Session["txtWeightKpi"] = "0.00";
                        }

                        if (jaDetails.keyResponsibilitiesWeight != null)
                        {
                            Session["txtWeightKey"] = jaDetails.keyResponsibilitiesWeight;
                        }
                        else
                        {
                            Session["txtWeightKey"] = "0.00";
                        }

                        if (jaDetails.secondaryActivitiesWeight != null)
                        {
                            Session["txtWeightSec"] = jaDetails.secondaryActivitiesWeight;
                        }
                        else
                        {
                            Session["txtWeightSec"] = "0.00";
                        }

                        if (jaDetails.otherActivitiesWeight != null)
                        {
                            Session["txtWeightOther"] = jaDetails.otherActivitiesWeight; ;
                        }
                        else
                        {
                            Session["txtWeightOther"] = "0.00";
                        }
                    }


                    //var JAMasterKeyResponsibilitiesDetail_2 = from s1 in JAMasterKeyResponsibilitiesDetail
                    //                                          select new
                    //                                          {
                    //                                              _id = s1.Key.id,
                    //                                              _addSubCheck = s1.Key.addSubCheck,
                    //                                              _isStatus = s1.Key.isStatus,
                    //                                              _idRefSub = s1.Key.idRefSub,
                    //                                              _jaMasterId = s1.Key.jaMasterId,
                    //                                              _levelDisplay = s1.Key.levelDisplay,
                    //                                              _descriptionKey = s1.Key.descriptionKey,
                    //                                              _goal = s1.Key.goal,
                    //                                              _weight = s1.Key.weight,
                    //                                              _sum = s1.Key.sumSubKey,,
                    //                                              _TitleTH = s1.employees.TitleTH,
                    //                                              _FirstNameTH = s1.employees.FirstNameTH,
                    //                                              _LastNameTH = s1.employees.LastNameTH,
                    //                                          };


                    

                    //var JAMasterKeyResponsibilitiesDetail_3 = from s1 in JAMasterKeyResponsibilitiesDetail
                    //                                          where s1.Key.id == ks._id
                    //                                          select new listkey
                    //                                          {
                    //                                              id = s1.Key.id,
                    //                                              addSubCheck = s1.Key.addSubCheck,
                    //                                              isStatus = s1.Key.isStatus,
                    //                                              idRefSub = s1.Key.idRefSub,
                    //                                              jaMasterId = s1.Key.jaMasterId,
                    //                                              levelDisplay = s1.Key.levelDisplay,
                    //                                              descriptionKey = s1.Key.descriptionKey,
                    //                                              goal = s1.Key.goal,
                    //                                              weight = s1.Key.weight,
                    //                                              sum = sumSubKey,
                    //                                              TitleTH = s1.employees.TitleTH,
                    //                                              FirstNameTH = s1.employees.FirstNameTH,
                    //                                              LastNameTH = s1.employees.LastNameTH,
                    //                                          };

                    ViewBag.listKey = JAMasterKeyResponsibilitiesDetail.Where(a => a.Key.isStatus == "A" && a.Key.jaMasterId == JAMaster2Id)
                                      .OrderBy(a => a.Key.levelDisplay).ThenBy(a => a.Key.isOder).ThenBy(a => a.Key.id).ToList();
                    ViewBag.listKpi = JAMasterKPIDetail.Where(a => a.Kpi.isStatus == "A" && a.Kpi.jaMasterId == JAMaster2Id).ToList();
                    ViewBag.listSecondKey = JAMasterSecondaryActivitiesDetail.Where(a => a.Sec.isStatus == "A" && a.Sec.jaMasterId == JAMaster2Id).ToList();
                    ViewBag.listOtherKey = JAMasterOtherActivitiesDetail.Where(a => a.Other.isStatus == "A" && a.Other.jaMasterId == JAMaster2Id).ToList();
                    ViewBag.listExtraKey = JAMasterExtraDetail.Where(a => a.Extra.isStatus == "A" && a.Extra.jaMasterId == JAMaster2Id).ToList();
                    return View();

                }
            }
            else
            {
                Session.Abandon();
                return View("../Home/LoginView");
            }
        }

        public ActionResult UpChange(int id, int jaMasterId, int idRefSub, int isOder)
        {

            int isOderR = isOder - 1;        
            
            if(isOderR == 0)
            {
                try
                {
                    int? subKeyChangeisOderMax = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.jaMasterId == jaMasterId && a.idRefSub == idRefSub).Max(a => a.isOder);
                    var subKeyChangeisOder = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.jaMasterId == jaMasterId && a.idRefSub == idRefSub && a.isOder == subKeyChangeisOderMax).Single();
                    var subKeyChangeisOderBefore = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.id == id).Single();

                    subKeyChangeisOder.isOder = 1;
                    subKeyChangeisOderBefore.isOder = subKeyChangeisOderMax;
                    db.Entry(subKeyChangeisOder).State = EntityState.Modified;
                    db.Entry(subKeyChangeisOderBefore).State = EntityState.Modified;
                    db.SaveChanges();

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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;

                }
            }
            else
            {
                try
                {
                    var subKeyChangeisOder = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.jaMasterId == jaMasterId && a.idRefSub == idRefSub && a.isOder == isOderR).Single();
                    var subKeyChangeisOderBefore = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.id == id).Single();
                    subKeyChangeisOder.isOder = subKeyChangeisOderBefore.isOder;
                    subKeyChangeisOderBefore.isOder = isOderR;
                    db.Entry(subKeyChangeisOder).State = EntityState.Modified;
                    db.Entry(subKeyChangeisOderBefore).State = EntityState.Modified;
                    db.SaveChanges();

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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;

                }
            }
            

            return RedirectToAction("CreateJA");
        }

        public ActionResult DownChange(int id, int jaMasterId, int idRefSub, int isOder)
        {
            int? subKeyChangeisOderMax = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.jaMasterId == jaMasterId && a.idRefSub == idRefSub).Max(a => a.isOder);
            int? isOderR = isOder + 1;

            if (isOderR > subKeyChangeisOderMax)
            {
                try
                {
                    var subKeyChangeisOder = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.jaMasterId == jaMasterId && a.idRefSub == idRefSub && a.isOder == 1).Single();
                    var subKeyChangeisOderBefore = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.id == id).Single();

                    subKeyChangeisOder.isOder = subKeyChangeisOderMax;
                    subKeyChangeisOderBefore.isOder = 1;
                    db.Entry(subKeyChangeisOder).State = EntityState.Modified;
                    db.Entry(subKeyChangeisOderBefore).State = EntityState.Modified;
                    db.SaveChanges();

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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;

                }
            }
            else
            {
                try
                {
                    var subKeyChangeisOder = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.jaMasterId == jaMasterId && a.idRefSub == idRefSub && a.isOder == isOderR).Single();
                    var subKeyChangeisOderBefore = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.id == id).Single();

                    subKeyChangeisOder.isOder = subKeyChangeisOderBefore.isOder;
                    subKeyChangeisOderBefore.isOder = isOderR;
                    db.Entry(subKeyChangeisOder).State = EntityState.Modified;
                    db.Entry(subKeyChangeisOderBefore).State = EntityState.Modified;
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }
            }
            return RedirectToAction("CreateJA");
        }

        public ActionResult SaveDraft()
        {
            Session["Alert"] = "67";
            Session["CheckSesWeight"] = "1";
            return RedirectToAction("CreateJA");
        }
        

        public ActionResult AddKeyView(int id)
        {
            if (Session["EmpID"] != null)
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
                        firstNameTH = s.employees.FirstNameTH + "  " + s.employees.LastNameTH,
                        id = s.JAManagerFlowApproves.id
                    });
                    ViewBag.ddljaManager = new SelectList(managerName2, "id", "firstNameTH");
                    ViewBag.jaMasterId = id;
                    return View();
                }
            }
            else
            {
                Session.Abandon();
                return View("../Home/LoginView");
            }           
        }

        public ActionResult AddSubKeyView(int id,int jaMasterId)
        {
            if (Session["EmpID"] != null)
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
                        firstNameTH = s.employees.FirstNameTH + "  " + s.employees.LastNameTH,
                        id = s.JAManagerFlowApproves.id
                    });

                    ViewBag.ddljaManager = new SelectList(managerName2, "id", "firstNameTH");
                    ViewBag.jaMasterId = jaMasterId;
                    ViewData["ListKey"] = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.id == id).Single();
                    return View();
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
           
        }

        public ActionResult EditKeyView(int id,int jaMasterId)
        {
            if (Session["EmpID"] != null)
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
                        firstNameTH = s.employees.FirstNameTH + "  " + s.employees.LastNameTH,
                        id = s.JAManagerFlowApproves.id
                    });

                    ViewBag.ddljaManager = new SelectList(managerName2, "id", "firstNameTH");

                    var edit = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.id == id).Single();
                    var managerDefault = managerName2.Where(a => a.id == edit.directorId).Single();
                    ViewBag.managerDefault = managerDefault.firstNameTH;

                    ViewBag.jaMasterId = jaMasterId;
                    ViewBag.subKeyId = id;
                    ViewData["keyListEdit"] = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.id == id && a.jaMasterId == jaMasterId).Single();

                    return View();
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult Add_Key(FormCollection fc, string id)
        {
            if (Session["EmpID"] != null)
            {
                //Check jaControl
                int jaMasterId = int.Parse(id);
                var jaControls = db.JAControls.Where(a => a.jaStatus == "O").Single();
                string yearOpen = jaControls.jaYear;
                var levelDisplayCheck = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.jaMasterId == jaMasterId && a.addSubCheck == "K").Count();
                int levelDisplay = levelDisplayCheck + 1;
                try
                {
                    JAMasterKeyResponsibilitiesDetail jaKpi = new JAMasterKeyResponsibilitiesDetail();
                    jaKpi.jaMasterId = jaMasterId;
                    //jaKpi.KPIId = kpiDes.id;
                    jaKpi.descriptionKey = fc["taKeyDetails"];
                    jaKpi.goal = fc["taKeyGoal"];
                    jaKpi.directorId = int.Parse(fc["firstNameTH"]);
                    jaKpi.weight = decimal.Parse(fc["txtKeyWeight"]);
                    jaKpi.addSubCheck = "K";
                    jaKpi.idRefSub = levelDisplay;
                    jaKpi.levelDisplay = levelDisplay;
                    jaKpi.createdDate = DateTime.Now;
                    jaKpi.isStatus = "A";

                    db.JAMasterKeyResponsibilitiesDetails.Add(jaKpi);
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }

                return RedirectToAction("CreateJA");
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult Add_subKey(FormCollection fc, string ja, string idRefSub, string levelDisplay)
        {
            if (Session["EmpID"] != null)
            {
                //Check jaControl
                int jaMasterId = int.Parse(ja);
                int idrefsub = int.Parse(idRefSub);
                int level = int.Parse(levelDisplay);
                var jaControls = db.JAControls.Where(a => a.jaStatus == "O").Single();
                string yearOpen = jaControls.jaYear;
                int startIsOrderCheck = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.idRefSub == idrefsub && a.addSubCheck == null).Count();
                int? startIsOrder = 0;
                if(startIsOrderCheck == 0)
                {
                    startIsOrder = 1;
                }
                else
                {
                    int? startIsOrderCheckMax = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.idRefSub == idrefsub && a.addSubCheck == null).Max(a => a.isOder);
                    startIsOrder = startIsOrderCheckMax + 1;
                }
                try
                {
                    JAMasterKeyResponsibilitiesDetail jaKpi = new JAMasterKeyResponsibilitiesDetail();
                    jaKpi.jaMasterId = jaMasterId;
                    //jaKpi.KPIId = kpiDes.id;
                    jaKpi.descriptionKey = fc["taSubKeyDetails"];
                    jaKpi.goal = fc["taSubKeyGoal"];
                    jaKpi.directorId = int.Parse(fc["firstNameTH"]);
                    jaKpi.weight = decimal.Parse(fc["txtSubKeyWeight"]);
                    jaKpi.idRefSub = idrefsub;
                    jaKpi.isOder = startIsOrder;
                    jaKpi.levelDisplay = level;
                    jaKpi.createdDate = DateTime.Now;
                    jaKpi.isStatus = "A";

                    db.JAMasterKeyResponsibilitiesDetails.Add(jaKpi);
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }

                return RedirectToAction("CreateJA");
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult Edit_Key(FormCollection fc, string id)
        {
            if (Session["EmpID"] != null)
            {
                //Check jaControl
                int subKeyid = int.Parse(id);
                var jaControls = db.JAControls.Where(a => a.jaStatus == "O").Single();
                string yearOpen = jaControls.jaYear;

                var Edit = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.id == subKeyid).Single();

                try
                {
                    JAMasterKeyResponsibilitiesDetail jaKpi = new JAMasterKeyResponsibilitiesDetail();
                    jaKpi.jaMasterId = Edit.jaMasterId;
                    jaKpi.refId = Edit.id;
                    jaKpi.descriptionKey = Edit.descriptionKey;
                    jaKpi.goal = Edit.goal;
                    jaKpi.directorId = Edit.directorId;
                    jaKpi.weight = Edit.weight;
                    jaKpi.idRefSub = Edit.idRefSub;
                    jaKpi.isOder = Edit.isOder;
                    jaKpi.levelDisplay = Edit.levelDisplay;
                    jaKpi.createdDate = Edit.createdDate;
                    jaKpi.createdBy = Edit.createdBy;
                    jaKpi.createdByIP = Edit.createdByIP;
                    jaKpi.updatedBy = Edit.updatedBy;
                    jaKpi.updatedDate = Edit.updatedDate;
                    jaKpi.updatedByIp = Edit.updatedByIp;
                    jaKpi.isStatus = "I";
                    jaKpi.subKeyId = Edit.subKeyId;
                    jaKpi.addSubCheck = Edit.addSubCheck;

                    db.JAMasterKeyResponsibilitiesDetails.Add(jaKpi);
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }


                try
                {

                    Edit.descriptionKey = fc["taKeyDetails"];
                    Edit.goal = fc["taKeyGoal"];
                    Edit.directorId = int.Parse(fc["firstNameTH"]);
                    Edit.weight = decimal.Parse(fc["txtKeyWeight"]);
                    Edit.updatedDate = DateTime.Now;

                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }
                return RedirectToAction("CreateJA");
            }
            else
            {
                return View("../Home/LoginView");
            }            
        }

        public ActionResult Delete_Key(int id)
        {
            if (Session["EmpID"] != null)
            {
                try
                {
                    JAMasterKeyResponsibilitiesDetail jaKpi = new JAMasterKeyResponsibilitiesDetail();
                    jaKpi = db.JAMasterKeyResponsibilitiesDetails.Find(id);
                    jaKpi.isStatus = "D";

                    db.Entry(jaKpi).State = EntityState.Modified;
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }

                return Redirect(Request.UrlReferrer.ToString());
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }




        public ActionResult AddSecondaryView(int id)
        {
            if (Session["EmpID"] != null)
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
                        firstNameTH = s.employees.FirstNameTH + "  " + s.employees.LastNameTH,
                        id = s.JAManagerFlowApproves.id
                    });

                    ViewBag.ddljaManager = new SelectList(managerName2, "id", "firstNameTH");

                    ViewBag.jaMasterId = id;
                    return View();
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult EditSecondaryView(int id, int jaMasterId)
        {
            if (Session["EmpID"] != null)
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
                        firstNameTH = s.employees.FirstNameTH + "  " + s.employees.LastNameTH,
                        id = s.JAManagerFlowApproves.id
                    });

                    ViewBag.ddljaManager = new SelectList(managerName2, "id", "firstNameTH");

                    var edit = db.JAMasterSecondaryActivitiesDetails.Where(a => a.id == id).Single();
                    var managerDefault = managerName2.Where(a => a.id == edit.directorId).Single();
                    ViewBag.managerDefault = managerDefault.firstNameTH;

                    ViewBag.jaMasterId = jaMasterId;
                    ViewBag.subKeyId = id;
                    ViewData["SecondaryListEdit"] = db.JAMasterSecondaryActivitiesDetails.Where(a => a.id == id && a.jaMasterId == jaMasterId).Single();
                    return View();
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult Edit_Secondary(FormCollection fc, string id)
        {
            if (Session["EmpID"] != null)
            {
                //Check jaControl
                int subKeyid = int.Parse(id);
                var jaControls = db.JAControls.Where(a => a.jaStatus == "O").Single();
                string yearOpen = jaControls.jaYear;


                var Edit = db.JAMasterSecondaryActivitiesDetails.Where(a => a.id == subKeyid).Single();

                try
                {
                   
                    JAMasterSecondaryActivitiesDetail jaKpi = new JAMasterSecondaryActivitiesDetail();

                    jaKpi.jaMasterId = Edit.jaMasterId;
                    jaKpi.descriptionSecondary = Edit.descriptionSecondary;
                    jaKpi.goal = Edit.goal;
                    jaKpi.weight = Edit.weight;
                    jaKpi.isStatus = "I";
                    jaKpi.refId = Edit.id;
                    jaKpi.directorId = Edit.directorId;
                    jaKpi.createdBy = Edit.createdBy;
                    jaKpi.createdDate = Edit.createdDate;
                    jaKpi.createdByIP = Edit.createdByIP;
                    jaKpi.updatedBy = Edit.updatedBy;
                    jaKpi.updatedDate = Edit.updatedDate;
                    jaKpi.updatedByIp = Edit.updatedByIp;

                    db.JAMasterSecondaryActivitiesDetails.Add(jaKpi);
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }


                try
                {
                    Edit.descriptionSecondary = fc["taSecDetails"];
                    Edit.goal = fc["taSecGoal"];
                    Edit.directorId = int.Parse(fc["firstNameTH"]);
                    Edit.weight = decimal.Parse(fc["txtSecWeight"]);
                    Edit.updatedDate = DateTime.Now;

                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }

                return RedirectToAction("CreateJA");
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult Delete_Secondary(int id)
        {
            if (Session["EmpID"] != null)
            {
                try
                {
                    JAMasterSecondaryActivitiesDetail jaKpi = new JAMasterSecondaryActivitiesDetail();
                    jaKpi = db.JAMasterSecondaryActivitiesDetails.Find(id);
                    jaKpi.isStatus = "D";

                    db.Entry(jaKpi).State = EntityState.Modified;
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }

                return Redirect(Request.UrlReferrer.ToString());
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult Add_Secondary(FormCollection fc, int id)
        {
            if (Session["EmpID"] != null)
            {
                //Check jaControl
                var jaControls = db.JAControls.Where(a => a.jaStatus == "O").Single();
                string yearOpen = jaControls.jaYear;

                try
                {
                    //string fcKpiDes = Int32.Parse(fc["KPIDescription"].ToString());
                    //string _KPIDescription = fc["KPIDescription"];
                    //var kpiDes = db.JAMasterKPIDetails.Where(a => a.KPIDescription.ToString().Equals(_KPIDescription.ToString())).Single();

                    JAMasterSecondaryActivitiesDetail jaKpi = new JAMasterSecondaryActivitiesDetail();
                    jaKpi.jaMasterId = id;
                    //jaKpi.KPIId = kpiDes.id;
                    jaKpi.descriptionSecondary = fc["taSecDetails"];
                    jaKpi.goal = fc["taSecGoal"];
                    jaKpi.directorId = int.Parse(fc["firstNameTH"]);
                    jaKpi.weight = decimal.Parse(fc["txtSecWeight"]);
                    jaKpi.createdDate = DateTime.Now;
                    jaKpi.isStatus = "A";

                    db.JAMasterSecondaryActivitiesDetails.Add(jaKpi);
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }

                return RedirectToAction("CreateJA"); ;
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }




        public ActionResult AddOtherView(int id)
        {
            if (Session["EmpID"] != null)
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
                        firstNameTH = s.employees.FirstNameTH + "  " + s.employees.LastNameTH,
                        id = s.JAManagerFlowApproves.id
                    });

                    ViewBag.ddljaManager = new SelectList(managerName2, "id", "firstNameTH");

                    ViewBag.jaMasterId = id;
                    return View();
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult EditOtherView(int id, int jaMasterId)
        {
            if (Session["EmpID"] != null)
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
                        firstNameTH = s.employees.FirstNameTH + "  " + s.employees.LastNameTH,
                        id = s.JAManagerFlowApproves.id
                    });

                    ViewBag.ddljaManager = new SelectList(managerName2, "id", "firstNameTH");

                    var edit = db.JAMasterOtherActivitiesDetails.Where(a => a.id == id).Single();
                    var managerDefault = managerName2.Where(a => a.id == edit.directorId).Single();
                    ViewBag.managerDefault = managerDefault.firstNameTH;

                    ViewBag.jaMasterId = jaMasterId;
                    ViewBag.subKeyId = id;
                    ViewData["OtherListEdit"] = db.JAMasterOtherActivitiesDetails.Where(a => a.id == id && a.jaMasterId == jaMasterId).Single();
                    return View();
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult Edit_Other(FormCollection fc, string id)
        {
            if (Session["EmpID"] != null)
            {
                //Check jaControl
                int subKeyid = int.Parse(id);
                var jaControls = db.JAControls.Where(a => a.jaStatus == "O").Single();
                string yearOpen = jaControls.jaYear;


                var Edit = db.JAMasterOtherActivitiesDetails.Where(a => a.id == subKeyid).Single();

                try
                {
                    JAMasterOtherActivitiesDetail jaKpi = new JAMasterOtherActivitiesDetail();

                    jaKpi.jaMasterId = Edit.jaMasterId;
                    jaKpi.descriptionOther = Edit.descriptionOther;
                    jaKpi.goal = Edit.goal;
                    jaKpi.weight = Edit.weight;
                    jaKpi.isStatus = "I";
                    jaKpi.refId = Edit.id;
                    jaKpi.directorId = Edit.directorId;
                    jaKpi.createdBy = Edit.createdBy;
                    jaKpi.createdDate = Edit.createdDate;
                    jaKpi.createdByIP = Edit.createdByIP;
                    jaKpi.updatedBy = Edit.updatedBy;
                    jaKpi.updatedDate = Edit.updatedDate;
                    jaKpi.updatedByIp = Edit.updatedByIp;

                    db.JAMasterOtherActivitiesDetails.Add(jaKpi);
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }


                try
                {
                    Edit.descriptionOther = fc["taOtherDetails"];
                    Edit.goal = fc["taOtherGoal"];
                    Edit.directorId = int.Parse(fc["firstNameTH"]);
                    Edit.weight = decimal.Parse(fc["txtOtherWeight"]);
                    Edit.updatedDate = DateTime.Now;

                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }

                return RedirectToAction("CreateJA");
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult Delete_Other(int id)
        {
            if (Session["EmpID"] != null)
            {
                try
                {
                    JAMasterOtherActivitiesDetail jaKpi = new JAMasterOtherActivitiesDetail();
                    jaKpi = db.JAMasterOtherActivitiesDetails.Find(id);
                    jaKpi.isStatus = "D";

                    db.Entry(jaKpi).State = EntityState.Modified;
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }

                return Redirect(Request.UrlReferrer.ToString());
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult Add_Other(FormCollection fc, int id)
        {
            if (Session["EmpID"] != null)
            {
                //Check jaControl
                var jaControls = db.JAControls.Where(a => a.jaStatus == "O").Single();
                string yearOpen = jaControls.jaYear;

                try
                {
                    //string fcKpiDes = Int32.Parse(fc["KPIDescription"].ToString());
                    //string _KPIDescription = fc["KPIDescription"];
                    //var kpiDes = db.JAMasterKPIDetails.Where(a => a.KPIDescription.ToString().Equals(_KPIDescription.ToString())).Single();

                    JAMasterOtherActivitiesDetail jaKpi = new JAMasterOtherActivitiesDetail();
                    jaKpi.jaMasterId = id;
                    //jaKpi.KPIId = kpiDes.id;
                    jaKpi.descriptionOther = fc["taOtherDetails"];
                    jaKpi.goal = fc["taOtherGoal"];
                    jaKpi.directorId = int.Parse(fc["firstNameTH"]);
                    jaKpi.weight = decimal.Parse(fc["txtOtherWeight"]);
                    jaKpi.createdDate = DateTime.Now;
                    jaKpi.isStatus = "A";

                    db.JAMasterOtherActivitiesDetails.Add(jaKpi);
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }

                return RedirectToAction("CreateJA");
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult AddExtraView(int id)
        {
            if (Session["EmpID"] != null)
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
                        firstNameTH = s.employees.FirstNameTH + "  " + s.employees.LastNameTH,
                        id = s.JAManagerFlowApproves.id
                    });

                    ViewBag.ddljaManager = new SelectList(managerName2, "id", "firstNameTH");

                    ViewBag.jaMasterId = id;
                    return View();
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult EditExtraView(int id, int jaMasterId)
        {
            if (Session["EmpID"] != null)
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
                        firstNameTH = s.employees.FirstNameTH + "  " + s.employees.LastNameTH,
                        id = s.JAManagerFlowApproves.id
                    });

                    ViewBag.ddljaManager = new SelectList(managerName2, "id", "firstNameTH");

                    var edit = db.JAMasterExtraDetails.Where(a => a.id == id).Single();
                    var managerDefault = managerName2.Where(a => a.id == edit.directorId).Single();
                    ViewBag.managerDefault = managerDefault.firstNameTH;

                    ViewBag.jaMasterId = jaMasterId;
                    ViewBag.subKeyId = id;
                    ViewData["ExtraListEdit"] = db.JAMasterExtraDetails.Where(a => a.id == id && a.jaMasterId == jaMasterId).Single();
                    return View();
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult Edit_Extra(FormCollection fc, string id)
        {
            if (Session["EmpID"] != null)
            {
                //Check jaControl
                int subKeyid = int.Parse(id);
                var jaControls = db.JAControls.Where(a => a.jaStatus == "O").Single();
                string yearOpen = jaControls.jaYear;


                var Edit = db.JAMasterExtraDetails.Where(a => a.id == subKeyid).Single();

                try
                {
                    JAMasterExtraDetail jaKpi = new JAMasterExtraDetail();

                    jaKpi.jaMasterId = Edit.jaMasterId;
                    jaKpi.descriptionExtra = Edit.descriptionExtra;
                    jaKpi.goal = Edit.goal;
                    jaKpi.weight = Edit.weight;
                    jaKpi.isStatus = "I";
                    jaKpi.refId = Edit.id;
                    jaKpi.directorId = Edit.directorId;
                    jaKpi.createdBy = Edit.createdBy;
                    jaKpi.createdDate = Edit.createdDate;
                    jaKpi.createdByIP = Edit.createdByIP;
                    jaKpi.updatedBy = Edit.updatedBy;
                    jaKpi.updatedDate = Edit.updatedDate;
                    jaKpi.updatedByIp = Edit.updatedByIp;

                    db.JAMasterExtraDetails.Add(jaKpi);
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }

                try
                {
                    Edit.descriptionExtra = fc["taExtraDetails"];
                    Edit.goal = fc["taExtraGoal"];
                    Edit.directorId = int.Parse(fc["firstNameTH"]);
                    Edit.weight = decimal.Parse(fc["txtExtraWeight"]);
                    Edit.updatedDate = DateTime.Now;

                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }

                return RedirectToAction("CreateJA");
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult Delete_Extra(int id)
        {
            if (Session["EmpID"] != null)
            {
                try
                {
                    JAMasterExtraDetail jaKpi = new JAMasterExtraDetail();
                    jaKpi = db.JAMasterExtraDetails.Find(id);
                    jaKpi.isStatus = "D";

                    db.Entry(jaKpi).State = EntityState.Modified;
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }

                return Redirect(Request.UrlReferrer.ToString());
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult Add_Extra(FormCollection fc, int id)
        {
            if (Session["EmpID"] != null)
            {
                //Check jaControl
                var jaControls = db.JAControls.Where(a => a.jaStatus == "O").Single();
                string yearOpen = jaControls.jaYear;

                try
                {
                    //string fcKpiDes = Int32.Parse(fc["KPIDescription"].ToString());
                    //string _KPIDescription = fc["KPIDescription"];
                    //var kpiDes = db.JAMasterKPIDetails.Where(a => a.KPIDescription.ToString().Equals(_KPIDescription.ToString())).Single();

                    JAMasterExtraDetail jaKpi = new JAMasterExtraDetail();
                    jaKpi.jaMasterId = id;
                    //jaKpi.KPIId = kpiDes.id;
                    jaKpi.descriptionExtra = fc["taExtraDetails"];
                    jaKpi.goal = fc["taExtraGoal"];
                    jaKpi.directorId = int.Parse(fc["firstNameTH"]);
                    jaKpi.weight = decimal.Parse(fc["txtExtraWeight"]);
                    jaKpi.createdDate = DateTime.Now;
                    jaKpi.isStatus = "A";

                    db.JAMasterExtraDetails.Add(jaKpi);
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }

                return RedirectToAction("CreateJA");
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        



        public ActionResult Check_Submit(FormCollection fc, int id)
        {
            if (Session["EmpID"] != null)
            {
                decimal WeightKpi = decimal.Parse(fc["txtWeightKpi"]);
                decimal WeightKey = decimal.Parse(fc["txtWeightKey"]);
                decimal WeightSec = decimal.Parse(fc["txtWeightSec"]);
                decimal WeightOther = decimal.Parse(fc["txtWeightOther"]);
                decimal SumWeight = WeightKpi + WeightKey + WeightSec + WeightOther;
                int jdIdsend = int.Parse(Session["jdId"].ToString());

                if (fc["saveDraft"] != null)
                {
                    Session["Alert"] = "67";
                    try
                    {
                        var save = db.JAMasters.Where(a => a.id == id).Single();

                        save.KPIWeight = WeightKpi;
                        save.keyResponsibilitiesWeight = WeightKey;
                        save.secondaryActivitiesWeight = WeightSec;
                        save.otherActivitiesWeight = WeightOther;
                        save.updatedDate = DateTime.Now;
                        save.updatedBy = Session["EmpID"].ToString();
                        db.SaveChanges();
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
                                raise = new InvalidOperationException(message, raise);
                            }
                        }
                        throw raise;
                    }

                    return Redirect(Request.UrlReferrer.ToString());

                }
                else if (fc["submit"] != null)
                {
                    int checkKpi = db.JAMasterKPIDetails.Where(a => a.jaMasterId == id && a.isStatus == "A").Count();
                    int checkKey = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.jaMasterId == id && a.isStatus == "A" && a.addSubCheck == "K").Count();
                    int checkSecondary = db.JAMasterSecondaryActivitiesDetails.Where(a => a.jaMasterId == id && a.isStatus == "A").Count();
                    int checkOther = db.JAMasterOtherActivitiesDetails.Where(a => a.jaMasterId == id && a.isStatus == "A").Count();
                    int checkExtra = db.JAMasterExtraDetails.Where(a => a.jaMasterId == id && a.isStatus == "A").Count();

                    bool checkSaveKpi = false, checkSaveKey = false, checkSaveSecondary = false, checkSaveOther = false, checkSaveExtra = false;

                    if (SumWeight == 100)
                    {
                        if (checkKpi != 0)
                        {
                            decimal? sumKpi = db.JAMasterKPIDetails.Where(a => a.jaMasterId == id && a.isStatus == "A").Sum(b => b.KPIWeight);
                            if (sumKpi != 100)
                            {
                                Session["Alert"] = "2";
                                return Redirect(Request.UrlReferrer.ToString());
                            }
                            else
                            {
                                checkSaveKpi = true;
                            }
                        }
                        else
                        {
                            checkSaveKpi = true;
                        }

                        if (checkKey != 0)
                        {
                            decimal? sumKey = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.jaMasterId == id && a.isStatus == "A" && a.addSubCheck == "K").Sum(b => b.weight);
                            if (sumKey != 100)
                            {
                                Session["Alert"] = "3";
                                return Redirect(Request.UrlReferrer.ToString());
                            }
                            else
                            {
                                var checkHeadKey = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.jaMasterId == id && a.isStatus == "A" && a.addSubCheck == "K").ToList();

                                foreach (var i in checkHeadKey)
                                {
                                    int checkSubKey = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.idRefSub == i.id && a.isStatus == "A" && a.addSubCheck == null).Count();
                                    if (checkSubKey != 0)
                                    {
                                        decimal? sumSubKey = db.JAMasterKeyResponsibilitiesDetails.Where(a => a.idRefSub == i.id && a.isStatus == "A" && a.addSubCheck == null).Sum(b => b.weight);
                                        if (sumSubKey != 100)
                                        {
                                            Session["Alert"] = "3";
                                            return Redirect(Request.UrlReferrer.ToString());
                                        }
                                        else
                                        {
                                            checkSaveKey = true;
                                        }
                                    }
                                    else
                                    {
                                        checkSaveKey = true;
                                    }
                                }
                            }
                        }
                        else
                        {
                            checkSaveKey = true;
                        }

                        if (checkSecondary != 0)
                        {
                            decimal? sumSecondary = db.JAMasterSecondaryActivitiesDetails.Where(a => a.jaMasterId == id && a.isStatus == "A").Sum(b => b.weight);
                            if (sumSecondary != 100)
                            {
                                Session["Alert"] = "4";
                                return Redirect(Request.UrlReferrer.ToString());
                            }
                            else
                            {
                                checkSaveSecondary = true;
                            }
                        }
                        else
                        {
                            checkSaveSecondary = true;
                        }

                        if (checkOther != 0)
                        {
                            decimal? sumOther = db.JAMasterOtherActivitiesDetails.Where(a => a.jaMasterId == id && a.isStatus == "A").Sum(b => b.weight);
                            if (sumOther != 100)
                            {
                                Session["Alert"] = "5";
                                return Redirect(Request.UrlReferrer.ToString());
                            }
                            else
                            {
                                checkSaveOther = true;
                            }
                        }
                        else
                        {
                            checkSaveOther = true;
                        }

                        if (checkExtra != 0)
                        {
                            decimal? sumExtra = db.JAMasterExtraDetails.Where(a => a.jaMasterId == id && a.isStatus == "A").Sum(b => b.weight);
                            if (sumExtra != 100)
                            {
                                Session["Alert"] = "6";
                                return Redirect(Request.UrlReferrer.ToString());
                            }
                            else
                            {
                                checkSaveExtra = true;
                            }
                        }
                        else
                        {
                            checkSaveExtra = true;
                        }
                    }
                    else
                    {
                        Session["Alert"] = "1";
                        return Redirect(Request.UrlReferrer.ToString());
                    }


                    if (checkSaveKpi == true && checkSaveSecondary == true && checkSaveOther == true && checkSaveExtra == true && checkSaveKey == true)
                    {
                        Session["Alert"] = "0";
                        try
                        {
                            var save = db.JAMasters.Where(a => a.id == id).Single();

                            save.KPIWeight = WeightKpi;
                            save.keyResponsibilitiesWeight = WeightKey;
                            save.secondaryActivitiesWeight = WeightSec;
                            save.otherActivitiesWeight = WeightOther;
                            save.jaStatus = "Waiting";
                            save.updatedDate = DateTime.Now;
                            save.submittedDate = DateTime.Now;
                            save.updatedBy = Session["EmpID"].ToString();
                            db.SaveChanges();
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
                                    raise = new InvalidOperationException(message, raise);
                                }
                            }
                            throw raise;
                        }

                        return RedirectToAction("JA", new { jdId = jdIdsend });
                    }
                    else
                    {
                        Session["Alert"] = "1";
                        return Redirect(Request.UrlReferrer.ToString());
                    }
                }
                else
                {
                    Session["Alert"] = "1";
                    return Redirect(Request.UrlReferrer.ToString());
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }



        public ActionResult AddKpiView(int id,string searchStringN,string searchStringN2)
        {
            if (Session["EmpID"] != null)
            {
                using (HRISEntities db = new HRISEntities())
                {
                    List<Employee> employees = db.Employees.ToList();
                    List<masterProject> masterProjects = db.masterProjects.ToList();

                    var KpiSearchPre = from e in employees
                                       join m in masterProjects on e.EmpID equals m.projectHeader into table1
                                       from m in table1.ToList()
                                       select new KpiSearch
                                       {
                                           employees = e,
                                           masterProjects = m,
                                       };


                    var result = from f in KpiSearchPre
                                 select f;

                    ViewBag.ShowDiv = false;
                    ViewBag.ShowDiv2 = false;
                    if (!String.IsNullOrEmpty(searchStringN))
                    {
                        result = result.Where(s => s.masterProjects.projectName.Contains(searchStringN));
                        ViewBag.ShowDiv = true;
                    }


                    if (!String.IsNullOrEmpty(searchStringN2))
                    {
                        result = result.Where(s => s.employees.FirstNameTH.Contains(searchStringN2)
                                || s.employees.LastNameTH.Contains(searchStringN2)
                                || s.employees.TitleTH.Contains(searchStringN2)
                                || s.employees.FirstNameEN.Contains(searchStringN2)
                                || s.employees.LastNameEN.Contains(searchStringN2)
                                || s.employees.TitleEN.Contains(searchStringN2));
                        ViewBag.ShowDiv = true;
                    }


                    if (!String.IsNullOrEmpty(searchStringN2) && !String.IsNullOrEmpty(searchStringN))
                    {
                        result = result.Where(s => s.employees.FirstNameTH.Contains(searchStringN2)
                                || s.employees.LastNameTH.Contains(searchStringN2)
                                || s.employees.TitleTH.Contains(searchStringN2)
                                || s.employees.FirstNameEN.Contains(searchStringN2)
                                || s.employees.LastNameEN.Contains(searchStringN2)
                                || s.employees.TitleEN.Contains(searchStringN2)
                                && s.masterProjects.projectName.Contains(searchStringN));
                        ViewBag.ShowDiv = true;
                    }



                    ViewData["project"] = db.masterProjects.Where(a => a.id == 1).Single(); //สร้างไว้เผื่อ
                    ViewBag.result = result.ToList();
                    Session["jaMasterId"] = id;

                    return View();
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }


        public ActionResult ReturnChooseProject(int id)
        {
            if (Session["EmpID"] != null)
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
                        firstNameTH = s.employees.FirstNameTH + "  " + s.employees.LastNameTH,
                        id = s.JAManagerFlowApproves.id
                    });

                    ViewData["project"] = db.masterProjects.Where(a => a.id == id).Single();
                    ViewBag.ShowDiv = false;
                    ViewBag.ShowDiv2 = true;
                    ViewBag.ddljaManager = new SelectList(managerName2, "id", "firstNameTH");

                    return View("AddKpiView");
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult Edit_Kpi(FormCollection fc, string id)
        {
            if (Session["EmpID"] != null)
            {
                //Check jaControl
                int kpiId = int.Parse(id);
                var jaControls = db.JAControls.Where(a => a.jaStatus == "O").Single();
                string yearOpen = jaControls.jaYear;


                var Edit = db.JAMasterKPIDetails.Where(a => a.id == kpiId).Single();

                try
                {
                    Edit.KPIGoal = fc["taKpiGoal"];
                    Edit.directorId = int.Parse(fc["firstNameTH"]);
                    Edit.KPIWeight = decimal.Parse(fc["txtKpiWeight"]);
                    Edit.updatedDate = DateTime.Now;

                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }

                return RedirectToAction("CreateJA");
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult Delete_Kpi(int id)
        {
            if (Session["EmpID"] != null)
            {
                Session["CheckSesWeight"] = "0";
                try
                {
                    JAMasterKPIDetail jaKpi = new JAMasterKPIDetail();
                    jaKpi = db.JAMasterKPIDetails.Find(id);
                    jaKpi.isStatus = "D";

                    db.Entry(jaKpi).State = EntityState.Modified;
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }

                return Redirect(Request.UrlReferrer.ToString());
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult EditKpiView(int id)
        {
            if (Session["EmpID"] != null)
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
                        firstNameTH = s.employees.FirstNameTH + "  " + s.employees.LastNameTH,
                        id = s.JAManagerFlowApproves.id
                    });

                    var edit = db.JAMasterKPIDetails.Where(a => a.id == id).Single();
                    SelectList ddljaManager = new SelectList(managerName2, "id", "firstNameTH");

                    var managerDefault = managerName2.Where(a => a.id == edit.directorId).Single();
                    ViewBag.managerDefault = managerDefault.firstNameTH;


                    ViewBag.ddljaManager = ddljaManager;
                    ViewBag.kpi = id;
                    ViewData["kpiListEdit"] = db.JAMasterKPIDetails.Where(a => a.id == id).Single();


                    return View();
                }
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public ActionResult Add_Kpi(int id, FormCollection fc)
        {
            if (Session["EmpID"] != null)
            {
                //Check jaControl
                var jaControls = db.JAControls.Where(a => a.jaStatus == "O").Single();
                string yearOpen = jaControls.jaYear;

                try
                {
                    JAMasterKPIDetail jaKpi = new JAMasterKPIDetail();
                    jaKpi.jaMasterId = id;
                    //jaKpi.KPIId = kpiDes.id;
                    jaKpi.KPIDescription = fc["taKpiProjectName"];
                    jaKpi.KPIGoal = fc["taKpiGoal"];
                    jaKpi.directorId = int.Parse(fc["firstNameTH"]);
                    jaKpi.KPIWeight = decimal.Parse(fc["txtKpiWeight"]);
                    jaKpi.createdDate = DateTime.Now;
                    jaKpi.isStatus = "A";

                    db.JAMasterKPIDetails.Add(jaKpi);
                    db.SaveChanges();
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
                            raise = new InvalidOperationException(message, raise);
                        }
                    }
                    throw raise;
                }

                return RedirectToAction("CreateJA");
            }
            else
            {
                return View("../Home/LoginView");
            }
            
        }

        public int returnId(string id)
        {
            int kpiId = int.Parse(id);
            return kpiId;
        }

        public ActionResult WeightKpiOnchange(string w)
        {
            if (Session["EmpID"] != null)
            {
                Session["CheckSesWeight"] = "0";
                Session["txtWeightKpi"] = w;
                return Redirect(Request.UrlReferrer.ToString());/*RedirectToAction("CreateJA");*/
            }
            else
            {
                return View("../Home/LoginView");
            }
        }

        public ActionResult WeightKeyOnchange(string w)
        {
            if (Session["EmpID"] != null)
            {
                Session["CheckSesWeight"] = "0";
                Session["txtWeightKey"] = w;
                return Redirect(Request.UrlReferrer.ToString());/*RedirectToAction("CreateJA");*/
            }
            else
            {
                return View("../Home/LoginView");
            }
        }

        public ActionResult WeightSecOnchange(string w)
        {
            if (Session["EmpID"] != null)
            {
                Session["CheckSesWeight"] = "0";
                Session["txtWeightSec"] = w;
                return Redirect(Request.UrlReferrer.ToString());/*RedirectToAction("CreateJA");*/
            }
            else
            {
                return View("../Home/LoginView");
            }
        }

        public ActionResult WeightOtherOnchange(string w)
        {
            if (Session["EmpID"] != null)
            {
                Session["CheckSesWeight"] = "0";
                Session["txtWeightOther"] = w;
                return Redirect(Request.UrlReferrer.ToString()); /*RedirectToAction("CreateJA");*/
            }
            else
            {
                return View("../Home/LoginView");
            }
        }
    }
}