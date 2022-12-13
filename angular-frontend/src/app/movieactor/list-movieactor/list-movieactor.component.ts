import { Component } from '@angular/core';
import { MovieActor } from 'src/app/model/movie-actor';
import { MovieActorService } from 'src/app/service/movieactor-service';

@Component({
  selector: 'app-list-movieactor',
  templateUrl: './list-movieactor.component.html',
  styleUrls: ['./list-movieactor.component.css']
})
export class ListMovieactorComponent {
  movieactors: MovieActor[] = [];  
  isFetching: boolean;
  msg: any;

  constructor(private movieActorService: MovieActorService) { }

  ngOnInit() {
    this.isFetching = true;
    this.movieActorService.getAllMovieActor().subscribe(
      {
        next: (respone) => {
          this.movieactors = respone;
          this.isFetching = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.isFetching = false;
        }
      }
    );
  }
}
