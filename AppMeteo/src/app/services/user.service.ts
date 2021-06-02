import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

const baseURL = 'http://localhost/apiMeteo/front/';

@Injectable({
  providedIn: 'root',
})
export class UserService {
  constructor(private http: HttpClient) {}

  // recupere tous les utilisateurs à l'initialisation
  readAllUsers(): Observable<any> {
    return this.http.get(`${baseURL}` + 'users');
  }

  // après selection d'un utilisateur recupère ses informations dont ses sondes - permet  l'affichage d'une liste de ses sondes en conséquence -
  readUser(id_user: any): Observable<any> {
    return this.http.get(`${baseURL}` + 'user/' + `${id_user}` + '/sonde');
  }

  // après sélection d'une des sondes de l'utilisateur, permet d'afficher ses relevés
  readSonde(id_sonde: any): Observable<any> {
    return this.http.get(`${baseURL}` + 'sonde/' + `${id_sonde}`);
  }

  readLastReleveSonde(id_sonde: any): Observable<any> {
    return this.http.get(`${baseURL}`+'dernierReleve/'+`${id_sonde}`);
  }

  readLastRelevesSonde(id_sonde: any): Observable<any> {
    return this.http.get(`${baseURL}`+'derniersReleves/'+`${id_sonde}`);
  }
}
