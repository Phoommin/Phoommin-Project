using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using FinalProjectPetey.Models;


namespace FinalProjectPetey.Controllers
{
    public class ShoppingCartController : Controller
    {
        PeteyEntities pe = new PeteyEntities();
        // GET: ShoppingCart
        public ActionResult Index()
        {
            return View();
        }

        private int isExisting(int id)
        {
            if (id >= 1 && id <= 39999)
            {
                List<item> cart = (List<item>)Session["cart"];
                for (int i = 0; i < cart.Count; i++)
                {
                    if (cart[i].Pet.Pet_Id == id)
                    {
                        return i;
                    }
                }
            }
            else if (id >= 40000 && id < 99500)
            {
                List<item> cart1 = (List<item>)Session["cart"];
                for (int i = 0; i < cart1.Count; i++)
                {
                    if (cart1[i].Product.Product_Id == id)
                    {
                        return i;
                    }
                }
            }
            else
            {
                List<item> cart2 = (List<item>)Session["cart"];
                for (int i = 0; i < cart2.Count; i++)
                {
                    if (cart2[i].Trainer.Trainer_Id == id)
                    {
                        return i;
                    }
                }
            }
            return -1;
        }

        public ActionResult AddtoCart(int id)
        {
            if (Session["cart"] == null)
            {
                if (id >= 1 && id <= 39999)
                {
                    Session["id"] = "1";
                    List<item> cart = new List<item>();
                    cart.Add(new item(pe.Pets.Find(id), 1));
                    Session["cart"] = cart;
                }
                else if (id >= 40000 && id < 99500)
                {
                    Session["id"] = "2";
                    List<item> cart = new List<item>();
                    cart.Add(new item(pe.Products.Find(id), 1));
                    Session["cart"] = cart;
                }
                else
                {
                    Session["id"] = "3";
                    List<item> cart = new List<item>();
                    cart.Add(new item(pe.Trainers.Find(id), 1));
                    Session["cart"] = cart;
                }
            }
            else
            {
                if (id >= 1 && id <= 39999)
                {
                    Session["id"] = "1";
                    List<item> cart = (List<item>)Session["cart"];
                    int index = isExisting(id);
                    if (index == -1)
                    {
                        cart.Add(new item(pe.Pets.Find(id), 1));
                    }
                    else
                    {
                        cart[index].Quantity++;
                    }
                    Session["cart"] = cart;

                }
                else if (id >= 40000 && id < 99500)
                {
                    Session["id"] = "2";
                    List<item> cart = (List<item>)Session["cart"];
                    int index = isExisting(id);
                    if (index == -1)
                    {
                        cart.Add(new item(pe.Products.Find(id), 1));
                    }
                    else
                    {
                        cart[index].QuantityProduct++;
                    }
                    Session["cart"] = cart;
                }
                else
                {
                    Session["id"] = "3";
                    List<item> cart = (List<item>)Session["cart"];
                    int index = isExisting(id);
                    if (index == -1)
                    {
                        cart.Add(new item(pe.Trainers.Find(id), 1));
                    }
                    else
                    {
                        cart[index].QuantityTrainer++;
                    }
                    Session["cart"] = cart;
                }
            }
            return View("ShoppingCart");
        }




        public ActionResult ViewDetails(int id)
        {
            ViewData["AniDetails"] = pe.Pets.Where(a => a.Pet_Id == id).Single();
            return View();
        }


        public ActionResult ViewDetailsProduct(int id)
        {
            ViewData["ProDetails"] = pe.Products.Where(a => a.Product_Id == id).Single();
            return View();
        }


        public ActionResult Comment()
        {
            return View();
        }

        [HttpPost]
        [AllowAnonymous]
        [ValidateAntiForgeryToken]
        public ActionResult Comment(int id)
        {

            return View();
        }


        public ActionResult ViewDetailsTrainer(int id)
        {
            ViewData["TrainDetails"] = pe.Trainers.Where(a => a.Trainer_Id == id).Single();
            return View();
        }

        public ActionResult InputDetailsBuy(int id)
        {
            if (Session["cart"] == null)
            {
                List<item> cart = new List<item>();
                cart.Add(new item(pe.Pets.Find(id), 1));
                Session["cart"] = cart;
            }
            else
            {
                List<item> cart = (List<item>)Session["cart"];
                int index = isExisting(id);
                if (index == -1)
                {
                    cart.Add(new item(pe.Pets.Find(id), 1));
                }
                else
                {
                    cart[index].Quantity++;
                }
                Session["cart"] = cart;
            }

            return View("InputDetailsBuy");
        }

        public ActionResult Buy(int id)
        {
            if (id >= 1 && id <= 39999)
            {
                ViewData["AniDetails"] = pe.Pets.Where(a => a.Pet_Id == id).Single();
                if (Session["cart"] == null)
                {
                    List<item> cart = new List<item>();
                    cart.Add(new item(pe.Pets.Find(id), 1));
                    Session["cart"] = cart;
                }
                else
                {
                    List<item> cart = (List<item>)Session["cart"];
                    int index = isExisting(id);
                    if (index == -1)
                    {
                        cart.Add(new item(pe.Pets.Find(id), 1));
                    }
                    else
                    {
                        cart[index].Quantity++;
                    }
                    Session["cart"] = cart;
                }
            }
            else if (id >= 40000 && id <= 99500)
            {
                ViewData["AniDetails"] = pe.Products.Where(a => a.Product_Id == id).Single();
                if (Session["cart"] == null)
                {
                    List<item> cart = new List<item>();
                    cart.Add(new item(pe.Products.Find(id), 1));
                    Session["cart"] = cart;
                }
                else
                {
                    List<item> cart = (List<item>)Session["cart"];
                    int index = isExisting(id);
                    if (index == -1)
                    {
                        cart.Add(new item(pe.Products.Find(id), 1));
                    }
                    else
                    {
                        cart[index].QuantityProduct++;
                    }
                    Session["cart"] = cart;
                }
            }
            else
            {
                ViewData["AniDetails"] = pe.Trainers.Where(a => a.Trainer_Id == id).Single();
                if (Session["cart"] == null)
                {
                    List<item> cart = new List<item>();
                    cart.Add(new item(pe.Trainers.Find(id), 1));
                    Session["cart"] = cart;
                }
                else
                {
                    List<item> cart = (List<item>)Session["cart"];
                    int index = isExisting(id);
                    if (index == -1)
                    {
                        cart.Add(new item(pe.Trainers.Find(id), 1));
                    }
                    else
                    {
                        cart[index].QuantityTrainer++;
                    }
                    Session["cart"] = cart;
                }
            }


            return View();
        }





        public ActionResult Delete(int id)
        {
            int index = isExisting(id);

            if (id >= 1 && id <= 39999)
            {
                List<item> cart = (List<item>)Session["cart"];
                if (cart[index].Quantity > 1)
                {
                    cart[index].Quantity--;
                }
                else
                {
                    cart.RemoveAt(index);
                }

                Session["cart"] = cart;
            }
            else if (id >= 40000 && id < 99500)
            {
                List<item> cart = (List<item>)Session["cart"];
                if (cart[index].QuantityProduct > 1)
                {
                    cart[index].QuantityProduct--;
                }
                else
                {
                    cart.RemoveAt(index);
                }

                Session["cart"] = cart;
            }
            else
            {
                List<item> cart = (List<item>)Session["cart"];
                if (cart[index].QuantityTrainer > 1)
                {
                    cart[index].QuantityTrainer--;
                }
                else
                {
                    cart.RemoveAt(index);
                }

                Session["cart"] = cart;
            }

            return View("ShoppingCart");
        }


        int id = 0;
        public ActionResult Save_Order(FormCollection fc)
        {
            List<item> items = (List<item>)Session["cart"];
            decimal summary = 0;
            try
            {
                Order orders = new Order();
                orders.Grand_total = summary;
                orders.Customer_Id = 1;
                orders.Card_No = fc["credit_card"];
                orders.Card_Name = fc["Card_Name"];
                orders.Order_date = DateTime.Now;
                orders.Order_status = "New";
                pe.Orders.Add(orders);
                pe.SaveChanges();
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
                foreach (item it in items)
                {

                    if (it.Pet.Pet_Id != null || it.Product.Product_Id != null || it.Trainer.Trainer_Id != null)
                    {
                        if (it.Pet.Pet_Id >= 1 && it.Pet.Pet_Id <= 39999)
                        {
                            id = it.Pet.Pet_Id;
                        }
                        else if (it.Product.Product_Id >= 40000 && it.Product.Product_Id <= 99500)
                        {
                            id = it.Product.Product_Id;
                        }
                        else
                        {
                            id = it.Trainer.Trainer_Id;
                        }
                    }
                    if (id >= 1 && id <= 39999)
                    {
                        Orders_Details od = new Orders_Details();
                        od.Order_Id = pe.Orders.Max(item => item.Order_Id);
                        od.Product_Id = it.Pet.Pet_Id;
                        od.Amount = it.Quantity;
                        od.Sub_total = (it.Pet.Price * it.Quantity);
                        pe.Orders_Details.Add(od);
                        pe.SaveChanges();
                    }
                    else if (id >= 40000 && id < 99500)
                    {
                        Orders_Details od = new Orders_Details();
                        od.Order_Id = pe.Orders.Max(item => item.Order_Id);
                        od.Product_Id = it.Product.Product_Id;
                        od.Amount = it.QuantityProduct;
                        od.Sub_total = (it.Product.Price * it.QuantityProduct);
                        pe.Orders_Details.Add(od);
                        pe.SaveChanges();
                    }
                    else
                    {
                        Orders_Details od = new Orders_Details();
                        od.Order_Id = pe.Orders.Max(item => item.Order_Id);
                        od.Product_Id = it.Trainer.Trainer_Id;
                        od.Amount = it.QuantityTrainer;
                        od.Sub_total = (it.Trainer.Price * it.QuantityTrainer);
                        pe.Orders_Details.Add(od);
                        pe.SaveChanges();
                    }
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
                        raise = new InvalidOperationException(message, raise);
                    }
                }
                throw raise;
            }
            return View("Confirm");
        }
    }

}
