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
    
    public partial class evaluatePercentManager
    {
        public int id { get; set; }
        public Nullable<int> yearControlId { get; set; }
        public Nullable<int> empId { get; set; }
        public string Title { get; set; }
        public string FirstName { get; set; }
        public string LastName { get; set; }
        public string Department { get; set; }
        public string Section { get; set; }
        public string Position { get; set; }
        public Nullable<decimal> percentKnowledge { get; set; }
        public Nullable<decimal> percentAttribute { get; set; }
        public string isActive { get; set; }
    }
}
