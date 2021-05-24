using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace SynchrotronHR.Models
{
    public class ViewModel1
    {
        public Employee employees { get; set; }
    }

    public class ViewModel
    {
        public Employee employees { get; set; }
        public JDMasterEmp jdMasterEmp { get; set; }
        public JDMaster jdMaster { get; set; }
        public JAMaster jaMaster { get; set; }
    }

    public class KpiSearch
    {
        public masterProject masterProjects { get; set; }
        public Employee employees { get; set; }
    }

    public class JaManager
    {
        public JAManagerFlowApprove JAManagerFlowApproves { get; set; }
        public Employee employees { get; set; }
    }

    public class JoinKpi
    {
        public JAMasterKPIDetail Kpi { get; set; }
        public JAManagerFlowApprove JAManagerFlowApproves { get; set; }
        public Employee employees { get; set; }
    }

    public class JoinKey
    {
        public JAMasterKeyResponsibilitiesDetail Key { get; set; }
        public JAManagerFlowApprove JAManagerFlowApproves { get; set; }
        public Employee employees { get; set; }
    }

    public class JoinSec
    {
        public JAMasterSecondaryActivitiesDetail Sec { get; set; }
        public JAManagerFlowApprove JAManagerFlowApproves { get; set; }
        public Employee employees { get; set; }
    }

    public class JoinOther
    {
        public JAMasterOtherActivitiesDetail Other { get; set; }
        public JAManagerFlowApprove JAManagerFlowApproves { get; set; }
        public Employee employees { get; set; }
    }

    public class JoinExtra
    {
        public JAMasterExtraDetail Extra { get; set; }
        public JAManagerFlowApprove JAManagerFlowApproves { get; set; }
        public Employee employees { get; set; }
    }

    public class JoinDirectorSection
    {
        public JAMasterKPIDetail Kpi { get; set; }
        public JAMasterKeyResponsibilitiesDetail Key { get; set; }
        public JAMasterSecondaryActivitiesDetail Sec { get; set; }
        public JAMasterOtherActivitiesDetail Other { get; set; }
        public JAMasterExtraDetail Extra { get; set; }
        public JAManagerFlowApprove JAManagerFlowApproves { get; set; }
        public Employee employees { get; set; }
    }

    public class ForManager
    {
        public JAManagerFlowApprove JAManagerFlowApproves { get; set; }
        public Employee employees { get; set; }
        public JDMasterEmp jdMasterEmp { get; set; }
        public JDMaster jdMaster { get; set; }
        public JAMaster jaMaster { get; set; }
        public View_ManagerViewJADetail V_jaManager { get; set; }
    }


    public class ForAdmin
    {
        public Employee employees { get; set; }
        public JDMasterEmp jdMasterEmp { get; set; }
        public JAMaster jaMaster { get; set; }
        public JDMaster jdMaster { get; set; }
    }

    public class InManager
    {
        public int _mid { get; set; }
        public string _managerLV2ID { get; set; }
        public string _managerNameLV2 { get; set; }
        public string _managerLV2Position { get; set; }

        public string _managerLV1ID { get; set; }
        public string _managerNameLV1 { get; set; }
        public string _managerLV1Position { get; set; }

        public string _managerLV0ID { get; set; }
        public string _managerNameLV0 { get; set; }
        public string _managerLV0Position { get; set; }
    }

    public class listkey
    {
        public int id { get; set; }
        public string addSubCheck { get; set; }
        public string isStatus { get; set; }
        public int? idRefSub { get; set; }

        public int? jaMasterId { get; set; }
        public int? levelDisplay { get; set; }
        public string descriptionKey { get; set; }

        public string goal { get; set; }
        public decimal? weight { get; set; }
        public decimal? sum { get; set; }

        public string TitleTH { get; set; }
        public string FirstNameTH { get; set; }
        public string LastNameTH { get; set; }

    }

    public class InManager2
    {
        public InManager inManager { get; set; }
    }


}