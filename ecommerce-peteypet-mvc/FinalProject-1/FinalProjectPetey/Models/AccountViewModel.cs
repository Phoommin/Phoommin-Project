using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Web;

namespace FinalProjectPetey.Models
{
    public class AccountViewModel
    {
    }

    public class LoginViewModel
    {
        [Required]
        [Display(Name = "Username")]
        public string Username { get; set; }

        [Required]
        [DataType(DataType.Password)]
        [Display(Name = "Password")]
        public string Password { get; set; }
    }


    public class RegisterViewModel
    {

        [Required]
        [Display(Name = "Username")]
        public string Username { get; set; }

        [Required]
        [StringLength(100, ErrorMessage = "The {0} must be at least {2} characters long.", MinimumLength = 6)]
        [DataType(DataType.Password)]
        [Display(Name = "Password")]
        public string Password { get; set; }

        [DataType(DataType.Password)]
        [Display(Name = "Confirm password")]
        [Compare("Password", ErrorMessage = "The password and confirmation password do not match.")]
        public string ConfirmPassword { get; set; }

        [Required]
        [EmailAddress]
        [Display(Name = "E-mail")]
        public string e_mail { get; set; }

        [Required]
        [Display(Name = "Fullname")]
        public string Fullname { get; set; }


        [Required]
        [Display(Name = "Sex")]
        public string Sex { get; set; }

        [Required]
        [Display(Name = "Birthdate")]
        [DataType(DataType.Date)]
        [DisplayFormat(DataFormatString = "{0:yyyy-MM-dd}", ApplyFormatInEditMode = true)]
        public DateTime Birthdate { get; set; }


        [Required]
        [Display(Name = "Phone_No")]
        public string Phone_No { get; set; }

        [Required]
        [Display(Name = "Address")]
        public string Address { get; set; }

        [Required]
        [Display(Name = "iframe")]
        public string iframe { get; set; }
    }


    public class RegistershopViewModel
    {

        [Required]
        [Display(Name = "Shop_Name")]
        public string Shop_Name { get; set; }


        [Required(ErrorMessage = "Please select a product")]
        [Display(Name = "Name_Bank")]
        public string Name_Bank { get; set; }
        public System.Web.Mvc.SelectList BankName { get; set; }

        [Required]
        [Display(Name = "Name_Owner")]
        public string Fullname { get; set; }


        [Required]
        [Display(Name = "Id_Bank")]
        public string Id_Bank { get; set; }

        [Required]
        [Display(Name = "Card_No")]
        public string Card_No { get; set; }

        [Required]
        [Display(Name = "Images")]
        public string Images { get; set; }

        [Required]
        [Display(Name = "UserType")]
        public string UserType { get; set; }

    }

    //public class Productss
    //{
    //    public int ID { set; get; }
    //    public string Nameb { set; get; }
    //}

    //public static class Repository
    //{
    //    public static IEnumerable<Productss> FetchProducts()
    //    {
    //        return new List<Productss>()
    //            {
    //                new Productss(){ ID = 1, Nameb = "Mobile" },
    //                new Productss(){ ID = 2, Nameb = "Laptop" },
    //                new Productss(){ ID = 3, Nameb = "IPad" }
    //            };
    //    }
    //}
}


//public class Productss
//{
//    public int ID { set; get; }
//    public string Nameb { set; get; }
//}

//public static class Repository
//{
//    public static IEnumerable<Productss> FetchProducts()
//    {
//        return new List<Productss>()
//            {
//                new Productss(){ ID = 1, Nameb = "Mobile" },
//                new Productss(){ ID = 2, Nameb = "Laptop" },
//                new Productss(){ ID = 3, Nameb = "IPad" }
//            };
//    }
//}

//[Required(ErrorMessage = "Please select a product")]
//public int SelectedProductId { get { return 2; } }
//public SelectList ProductList { get; set; }