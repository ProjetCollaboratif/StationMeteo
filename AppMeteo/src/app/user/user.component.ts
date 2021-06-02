import { Component, OnInit } from '@angular/core';
import { UserService } from '../services/user.service';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css'],
})
export class UserComponent implements OnInit {

  users: any;
  user: any;
  sondeSelectionnee: any;

  sondeSelectionneeActuellement: any;

  userOptionSelectDefault: any = 2;
  idUserSelected: any = '3';

  isUserSelected: any = false;
  isSondeSelected: any = false;

  visualRangeHumidite: any = {
    startValue: 0,
    endValue: 100
  };
  visualRangeTemperature: any = {
    startValue: 0,
    endValue: 60
  };
  markersData: any ;
  mapMarkerUrl = "https://js.devexpress.com/Demos/RealtorApp/images/map-marker.png";

  constructor(private userService: UserService) {
    // ligne IMPORTANTE : permet de lier le this dans la fonction selectSonde au composant, sans ça le this correspond au bouton et ne fonctionne pas
    this.selectSonde = this.selectSonde.bind(this);

    this.users = [];
    this.user = [];
    this.sondeSelectionnee = [];
    this.sondeSelectionneeActuellement = [{
      IdReleve: "",
      IdSonde: "",
      Temperature: "",
      Humidite: "",
      Date: "",
      Temps: ""
      }];
    this.markersData =  [
      {
        location : "44.834894, -0.572692"
      },
      {
        location: "44.851601, -0.516764"
      },
      {
        location: "44.8481128, -0.653775"
      },
      {
        location: "44.804402, -0.632544"
      }
    ]
  }

  ngOnInit(): void {
    this.readAllUsers();
    this.defaultSelectUser();
  }

  // à l'initialisation
  readAllUsers() {
    this.userService.readAllUsers().subscribe(
      //  ici users_ en représente les données récupérées
      // qu'on attribue à la propriété users du composant
      (users_) => {
        this.users = users_;
        console.log(this.users);
      },
      (error) => {
        console.log(error);
      }
    );
  }

  defaultSelectUser(): void {
    this.userService.readUser(this.idUserSelected).subscribe(
      (user_) => {
        this.user = user_;
      },
      (error) => {
        error;
      }
    );
  }

  // à la selection d'un user le paramètre e permet de récupérer les infos associées à l'évènement,
  // ici on s'en sert pour le e.target.value qui représente l'id_user dont nous avons besoin
  selectUser(e: any) {
    console.log(e.target.value);

    this.userService.readUser(e.target.value).subscribe(
      //  ici user représente les données récupérées
      // qu'on attribue à la propriété user du composant
      (user_) => {
        this.user = user_;
      }
    );
    console.log(this.user);
    this.isUserSelected = true;

    // permet au changement d'user de ne plus afficher les relevés de la précédente sonde séléctionnée le temps d'en choisir une autre
    this.isSondeSelected = false;
  }

  // à la sélection d'une sonde
  selectSonde(e: any) {
    console.log(e.row.data);
    let idSonde = e.row.data['IdSonde'];
    this.userService.readSonde(idSonde).subscribe((sonde) => {
      this.sondeSelectionnee = sonde;
    });

    this.userService.readLastReleveSonde(idSonde).subscribe((sonde)=> {
      this.sondeSelectionneeActuellement = sonde;
    })
    this.isSondeSelected = true;

    

    console.log(idSonde);
    console.log(this.sondeSelectionnee);
    let TemperatureActuelle = this.sondeSelectionneeActuellement.map(
      (t: any) => t.Temps)
    console.log("Temperature Actuelle", TemperatureActuelle);
    console.log("Sonde actuellement",this.sondeSelectionneeActuellement);
  };

  sharemailUrl() {
    let Sonde = this.sondeSelectionneeActuellement.map(
      (s: any) => s.IdSonde)
    
    if(Sonde == "1"){Sonde = "Bordeaux"};
    if(Sonde == "2"){Sonde = "Mérignac"};
    if(Sonde == "3"){Sonde = "Pessac"};
    if(Sonde == "4"){Sonde = "Cenon"};
   
    let TempsActuel = this.sondeSelectionneeActuellement.map(
      (t: any) => t.Temps)
    let Temperature = this.sondeSelectionneeActuellement.map(
      (c: any) => c.Temperature)
   
      window.open('mailto:?subject=' + 'Météo' + '&body=' + 
    `Bonjour, actuellement à  ${Sonde} le temps est ${TempsActuel} et il fait ${Temperature} °C`);
    return false;
  }
}
