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
    
    public partial class KPIReport
    {
        public int id { get; set; }
        public Nullable<int> KPIId { get; set; }
        public Nullable<int> reportQuarter { get; set; }
        public string reportResult { get; set; }
        public Nullable<decimal> reportScore { get; set; }
        public string reportRemark { get; set; }
        public string path { get; set; }
        public string fileName { get; set; }
        public string fileNameOld { get; set; }
        public Nullable<int> createdBy { get; set; }
        public Nullable<System.DateTime> cretaedDate { get; set; }
        public string reportStatus { get; set; }
    }
}
