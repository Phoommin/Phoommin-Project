﻿//------------------------------------------------------------------------------
// <auto-generated>
//     This code was generated from a template.
//
//     Manual changes to this file may cause unexpected behavior in your application.
//     Manual changes to this file will be overwritten if the code is regenerated.
// </auto-generated>
//------------------------------------------------------------------------------

namespace SynchrotronHR.Models
{
    using System;
    using System.Data.Entity;
    using System.Data.Entity.Infrastructure;
    
    public partial class HRISEntities : DbContext
    {
        public HRISEntities()
            : base("name=HRISEntities")
        {
        }
    
        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {
            throw new UnintentionalCodeFirstException();
        }
    
        public virtual DbSet<account> accounts { get; set; }
        public virtual DbSet<AccountJD> AccountJDs { get; set; }
        public virtual DbSet<accountManager> accountManagers { get; set; }
        public virtual DbSet<Employee> Employees { get; set; }
        public virtual DbSet<evaluatePercentManager> evaluatePercentManagers { get; set; }
        public virtual DbSet<JAControl> JAControls { get; set; }
        public virtual DbSet<JAManagerFlowApprove> JAManagerFlowApproves { get; set; }
        public virtual DbSet<JAMaster> JAMasters { get; set; }
        public virtual DbSet<JAMasterExtraDetail> JAMasterExtraDetails { get; set; }
        public virtual DbSet<JAMasterKeyResponsibilitiesDetail> JAMasterKeyResponsibilitiesDetails { get; set; }
        public virtual DbSet<JAMasterKPIDetail> JAMasterKPIDetails { get; set; }
        public virtual DbSet<JAMasterOtherActivitiesDetail> JAMasterOtherActivitiesDetails { get; set; }
        public virtual DbSet<JAMasterSecondaryActivitiesDetail> JAMasterSecondaryActivitiesDetails { get; set; }
        public virtual DbSet<JDMaster> JDMasters { get; set; }
        public virtual DbSet<JDMasterEmp> JDMasterEmps { get; set; }
        public virtual DbSet<JDMasterSub> JDMasterSubs { get; set; }
        public virtual DbSet<KPI> KPIs { get; set; }
        public virtual DbSet<KPIJoin> KPIJoins { get; set; }
        public virtual DbSet<KPIReport> KPIReports { get; set; }
        public virtual DbSet<KPIResponsible> KPIResponsibles { get; set; }
        public virtual DbSet<masterAtribute> masterAtributes { get; set; }
        public virtual DbSet<masterDDL> masterDDLs { get; set; }
        public virtual DbSet<masterKPIType> masterKPITypes { get; set; }
        public virtual DbSet<masterKPITypeSub> masterKPITypeSubs { get; set; }
        public virtual DbSet<masterKPIYear> masterKPIYears { get; set; }
        public virtual DbSet<masterKPIYearControl> masterKPIYearControls { get; set; }
        public virtual DbSet<masterProject> masterProjects { get; set; }
        public virtual DbSet<TransactionKPIDisplay> TransactionKPIDisplays { get; set; }
    }
}
