//------------------------------------------------------------------------------
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
    using System.Collections.Generic;
    
    public partial class KPI
    {
        public int id { get; set; }
        public Nullable<int> KPITypeId { get; set; }
        public Nullable<int> KPITypeSubId { get; set; }
        public Nullable<int> KPIYear { get; set; }
        public Nullable<int> ProjectId { get; set; }
        public string KPIName { get; set; }
        public string KPIDetail { get; set; }
        public string KPIGoal { get; set; }
        public Nullable<decimal> KPIWeight { get; set; }
        public string KPIResult { get; set; }
        public Nullable<decimal> KPIScore { get; set; }
        public Nullable<int> KPIHeader { get; set; }
        public Nullable<int> isOrder { get; set; }
        public Nullable<decimal> GoalRang1 { get; set; }
        public Nullable<decimal> GoalRang2 { get; set; }
        public Nullable<decimal> GoalRang3 { get; set; }
        public Nullable<decimal> GoalRang4 { get; set; }
        public Nullable<decimal> GoalRang5 { get; set; }
        public string Remark { get; set; }
        public string KPIStatus { get; set; }
    }
}
