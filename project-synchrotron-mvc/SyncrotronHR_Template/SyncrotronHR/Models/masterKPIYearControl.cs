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
    
    public partial class masterKPIYearControl
    {
        public int id { get; set; }
        public Nullable<int> KPIYearId { get; set; }
        public Nullable<int> KPIQuarterId { get; set; }
        public string KPIDetail { get; set; }
        public string KPIStatus { get; set; }
        public string StatusLV1Evaluated { get; set; }
        public string StatusLV2Evaluated { get; set; }
        public Nullable<System.DateTime> createdDate { get; set; }
    }
}
