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
    
    public partial class JAMasterOtherActivitiesDetail
    {
        public int id { get; set; }
        public Nullable<int> jaMasterId { get; set; }
        public string descriptionOther { get; set; }
        public string goal { get; set; }
        public Nullable<decimal> weight { get; set; }
        public string isStatus { get; set; }
        public Nullable<int> refId { get; set; }
        public Nullable<int> directorId { get; set; }
        public string createdBy { get; set; }
        public Nullable<System.DateTime> createdDate { get; set; }
        public string createdByIP { get; set; }
        public string updatedBy { get; set; }
        public Nullable<System.DateTime> updatedDate { get; set; }
        public string updatedByIp { get; set; }
    }
}
