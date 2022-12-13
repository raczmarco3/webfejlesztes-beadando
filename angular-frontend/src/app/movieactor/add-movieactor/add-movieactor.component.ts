import { Component } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { Actor } from 'src/app/model/actor';
import { Movie } from 'src/app/model/movie';
import { ActorService } from 'src/app/service/actor-service';
import { MovieService } from 'src/app/service/movie-service';
import { MovieActorService } from 'src/app/service/movieactor-service';

@Component({
  selector: 'app-add-movieactor',
  templateUrl: './add-movieactor.component.html',
  styleUrls: ['./add-movieactor.component.css']
})
export class AddMovieactorComponent {

  constructor(private movieService:MovieService, private actorService: ActorService, 
    private movieActorService: MovieActorService) {}

  movies: Movie[] = [];
  actors: Actor[] = [];
  obj: any;
  jsonContent: JSON;
  msg: any;
  processing: boolean;

  addMovieActorForm = new FormGroup({
    movie:new FormControl(),
    actor: new FormControl()
  });

  ngOnInit() {
    this.processing = true;
    this.movieService.getAllMovie().subscribe(
      {
        next: (respone) => {
          this.movies = respone;    
          this.processing = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.processing = false; 
        }
      }
    );  
    
    this.actorService.getAllActor().subscribe(
      {
        next: (respone) => {
          this.actors = respone;     
          this.processing = false;   
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.processing = false; 
        }
      }
    );  
  }

  onSubmit() {
    this.obj = {
      "movieId": this.addMovieActorForm.get('movie')?.value,
      "actorId": this.addMovieActorForm.get('actor')?.value
    };

    this.jsonContent = <JSON>this.obj;

    this.processing = true;
    this.movieActorService.addMovieActor(this.jsonContent).subscribe(
      {
        next: (msg) => {
          this.msg = msg.msg;
          this.processing = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.processing = false;
        }
      }
    )
  }

}
